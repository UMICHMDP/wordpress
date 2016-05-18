;(function($){
    alert('this file is not used');
    var mediaSelector = {
        __onSelect: null,
        __multiple: false,
        activeFrame: false,
        frame: function( multiple ) {
            multiple = typeof multiple == 'undefined' ? 0 : ( multiple ? 1 : 0)
            if ( !this._frame ){
                this._frame = [];
            }
            if( !this._frame[multiple] ){
                this._frame[multiple] = wp.media({
                    title: 'Select Media',
                    button: {
                        text: 'Insert'
                    },
                    multiple: multiple ? true : false
                });


                this._frame[multiple].state('library').on( 'select', this.select );
            }
            return this._frame[multiple];
        },

        select: function() {

            if( $.isFunction( mediaSelector.__onSelect ) ){
                var source = this.get( 'selection' )

                if( !mediaSelector.__multiple ){
                    source = source.single().toJSON();
                }else{

                    source = source.toJSON();

                }
                mediaSelector.__onSelect.call( mediaSelector._frame, source );
                mediaSelector.__onSelect = null;
            }
        },
        open: function( args ) {
            args = $.extend({
                multiple: false,
                onSelect: function(){}
            }, args || {});
            if( $.isFunction( args.onSelect )  ){
                mediaSelector.__onSelect = args.onSelect;
                mediaSelector.__multiple = args.multiple;
                var f = mediaSelector.frame(args.multiple);
                f.open();
            }
        }
    };
    var CertificateDesigner = Backbone.View.extend({
        options: null,
        events: {
            'click #select-cert-template': 'updateTemplate',
            'click .cert-object-controls > a': 'objectCommand',
            'change input': 'updateLayerOptions',
            'change select': 'updateLayerOptions',
            'click .cert-close-options-panel': 'hideOptions',
            'click .cert-options-cmd button': 'saveOptions'
        },
        dom: {},
        frame: {
            width: 0,
            height: 0,
            ratio: 0
        },
        canvasLoaded: false,
        activateObject: false,
        fieldProperties: [
            'left', 'top', 'fontSize', 'width', 'height', 'lineHeight', 'text'
        ],
        initialize: function(options){
            _.bindAll( this,
                '_dragField',
                '_dropOver',
                '_dropOut',
                '_dropField',
                'onObjectRotating',
                'onObjectSelected',
                'onObjectMoving',
                'onObjectMousedown',
                'onObjectMouseup',
                'onBeforeSelectionCleared',
                'limitObjectScale',
                '_beforeSubmit',
                'initDesigner',
                'onResize'
            );
            this.options = options;
            this.render();
            this.commonFunction();
        },
        onResize: function(){
            if( this.$canvas.width < this.$el.width() ){

            }
        },
        commonFunction: function(){
            $('form#post').submit(this._beforeSubmit);
            this.$('.cert-layer-options').draggable({
                handle: '>h3'
            });
            _.defer(function(app){
                $(document).keydown(function(e) {
                    if(e.keyCode == 13) {
                        app.updateLayerOptions(e);
                        e.preventDefault();
                    }
                })
            }, this);
        },
        updateTemplate: function(){
            var that = this;
            mediaSelector.open({
                multiple: false,
                onSelect: function(source){
                    //alert(JSON.stringify(source))
                    that.$('input[name="cert[id]"]').val(source.id);
                    if( source.sizes ){
                        that.$('img.cert-bg').attr('src', source.sizes.full.url)
                    }else{
                        that.$('img.cert-bg').attr('src', source.url)
                    }
                }
            })
        },
        render: function(){
            var attributes = {},
                element = this.options.element,
                $template = $(wp.template('certificate')(this.options));
            _.each($template.get(0).attributes, function (attr) {
                attributes[attr.name] = attr.value;
            });
            $(element).replaceWith( this.$el.attr(attributes).html($template.html()) );
            this.dom = {
                lines: {
                    $x: this.$('.cert-line.vertical'),
                    $y: this.$('.cert-line.horizontal')
                },
                $position: this.$('.cert-layer-position'),
                $editor: this.$('.cert-editor'),
                $cert: this.$('.cert-bg')
            }
            this.$('.cert-fields > ul > li').draggable({
                revert: true,
                start: function(evt, ui){
                    ui.helper.css("z-index", 100);
                },
                drag: this._dragField,
                stop: function(evt, ui){
                    ui.helper.css("z-index", "");
                }
            });
            this.$('.cert-editor').droppable({
                drop: this._dropField,
                over: this._dropOver,
                out: this._dropOut,
                accept: '.cert-layer-field-add'
            });
            this.$('.cert-bg').load(this.initDesigner);
        },
        onObjectSelected: function(e){
            _.defer(function(app, event){
                var $object = event.target,
                    options = app.getObjectOptions( $object );
                app.showObjectControls( $object );
                //app.loadObjectSettings( $object );
            }, this, e);
        },
        onObjectMoving: function(e){
            _.defer(function(app, event){
                var $object = event.target,
                    options = app.getObjectOptions( $object );
                app.showLines({top: $object.top - 1, left: $object.left - 1});
                app.hideObjectControls();
            }, this, e);
        },
        onObjectRotating: function(e){
            _.defer(function(app, event) {
                var $object = app.$canvas.getActiveObject(),
                    angle = app.toFixed($object.angle);
                app.$('input[name="angle"]').val(angle).siblings('.cert-option-slider').slider('option', 'value', angle);
            }, this, e);
        },
        onObjectMouseup: function(e){
            _.defer(function(app, event){
                app.hideLines();
            }, this, e);
        },
        onObjectMousedown: function(e){
            _.defer(function(app, event){
                var $activeObject = app.$canvas.getActiveObject();
                if( ( app.activeObject && $activeObject && app.activeObject.name != $activeObject.name ) || ( $activeObject && ! app.activeObject ) ) {
                    app.showObjectControls(event.target);
                    app.loadObjectSettings(event.target);
                }
                app.activeObject = event.target;
            }, this, e);
        },
        onBeforeSelectionCleared: function(e){
            _.defer(function(app, event){
                app.hideObjectControls();
                app.$('.cert-layer-options').hide();
            }, this, e);
        },
        limitObjectScale: function(e){
            _.defer(function(app, event){
                var $object = app.$canvas.getActiveObject(),
                    scaleX = app.toFixed($object.scaleX),
                    scaleY = app.toFixed($object.scaleY);
                if( $object.flipX ){
                    scaleX = -scaleX;
                }
                if( $object.flipY ){
                    scaleY = -scaleY;
                }
                app.$('input[name="scaleX"]').val(scaleX).siblings('.cert-option-slider').slider('option', 'value', scaleX);
                app.$('input[name="scaleY"]').val(scaleY).siblings('.cert-option-slider').slider('option', 'value', scaleY);
            }, this, e);
        },
        showObjectControls: function( $object ){
            if( ! $object ) return;
            var $controls = this.$('.cert-object-controls').show();
            $controls.css({
                top: $object.getTop() - $controls.outerHeight() - 5,
                left: $object.getLeft()
            });
            $controls.data('object', $object);
        },
        hideObjectControls: function(){
            this.$('.cert-object-controls').hide();
        },
        objectCommand: function(e){
            e.preventDefault();
            var $command = $(e.target),
                action = $command.data('action'),
                $object = this.$('.cert-object-controls').data('object');
            switch(action){
                case 'edit':
                    this.loadObjectSettings($object);
                    break;
                case 'remove':
                    this.$canvas.remove($object);
                    break;
            }
        },
        loadObjectSettings: function($object){
            if( ! this.canvasLoaded ) return;

            this.$('.cert-options')
                .html('')
                .addClass('loading');
            this.$('.cert-layer-options > h3 > span').html( '' );
            this.$('.cert-options-cmd button').attr('disabled', true);
            this.$('.cert-layer-options')
                .css({
                    left: this.$el.position().left + this.$el.width() + 100
                })
                .show();

            var objectOptions = this.getObjectOptions( $object );
            if( objectOptions.flipX ){
                objectOptions.scaleX = -objectOptions.scaleX;
            }
            if( objectOptions.flipY ){
                objectOptions.scaleY = -objectOptions.scaleY;
            }
            $.ajax({
                url: this.options.ajax,
                dataType: 'json',
                type: 'post',
                context: this,
                data: {
                    action: 'cert_load_settings',
                    data: this._abc( objectOptions )
                },
                success: function(response){
                    this.$('.cert-layer-options > h3 > span').html( ' - '+response.name );
                    this.$('.cert-options').html( response.html ).removeClass('loading');
                    this.$('.cert-options-cmd button').removeAttr('disabled');
                },
                error: function(){
                    this.$('.cert-layer-options > h3 > span').html( ' - '+response.name );
                    this.$('.cert-options').html( 'Error!' ).removeClass('loading');
                }
            });
        },
        updateLayerOptions: function(e){
            var $object = this.$canvas.getActiveObject(),
                $option = $(e.target),
                prop = $option.attr('name'),
                val = $option.val(),
                options = {};
            switch(prop) {
                case 'textAlign':
                    options.originX = val;
                    break;
                case 'color':
                    $object.set('fill', val);
                    break;
                case 'scaleX':
                case 'scaleY':
                    if(val < 0){
                        if( prop == 'scaleX' ){
                            $object.flipX = true;
                        }else{
                            $object.flipY = true;
                        }
                    }else{
                        if( prop == 'scaleX' ){
                            $object.flipX = false;
                        }else{
                            $object.flipY = false;
                        }
                    }
                    options[prop] = this.toFixed( Math.abs( val ) );
                    break;
                case 'fontFamily':
                    if( val.match(/^::/) ){
                        this.loadGoogleFont(val.replace(/^::/, ''), $object, function(font, $object){
                            if( ! $object ) $object = this.$canvas.getActiveObject();
                            $object.set('fontFamily', font);
                            setTimeout($.proxy(function() {
                                this.$canvas.renderAll();
                            }, this), 450)
                        })
                        break;
                    }
                default:
                    if( $option.attr('type') == 'number') {
                        options[prop] = this.toFixed(val);
                    }else{
                        options[prop] = val;
                    }
            }
            options = this._def(options);
            _.each(options, function(v, k){ $object.set(k, v)})
            $object.setCoords();
            this.$canvas.renderAll();
            e.preventDefault();
            return false;
        },
        toFixed: function(num){
            return Math.ceil(num * 10)/10;
        },
        saveOptions: function(e){
            var data = {
                    layers: [],
                    preview: ''
                },
                that = this,
                $activeObject = this.$canvas.getActiveObject();

            _.each( this.$canvas.getObjects(), function($object){
                var objectOptions = this.getObjectOptions($object);
                if( objectOptions.flipX ){
                    objectOptions.scaleX = -objectOptions.scaleX;
                }
                if( objectOptions.flipY ){
                    objectOptions.scaleY = -objectOptions.scaleY;
                }

                data.layers.push(this._abc( objectOptions ));
            }, this);
            this.$canvas.deactivateAll().renderAll();
            data.preview = this.$canvas.toDataURL();
            this.$canvas.setActiveObject($activeObject);
            this.$('.cert-options-cmd button').attr('disabled', true);
            this.$('.cert-layer-options').css("opacity", 0.8)
            $.ajax({
                url: this.options.ajax,
                data: {
                    action: 'cert_save_layer',
                    cert_id: this.options.post_id,
                    data: data
                },
                dataType: 'html',
                type: 'post',
                success: function(response){
                    that.$('.cert-options-cmd button').removeAttr('disabled');
                    that.$('.cert-layer-options').css("opacity", 1)
                },
                error: function(){
                    that.$('.cert-options-cmd button').removeAttr('disabled');
                    that.$('.cert-layer-options').css("opacity", 1)
                }
            });
        },
        loadGoogleFont: function(font, $object, callback){
            var that = this,
                id = 'google-font-' + font.replace(/\s+/, '-').toLowerCase(),
                $link = $('link#'+id);
            if( $link.length ){
                $.isFunction(callback) && callback.call(that, font, $object);
            }else {
                $link = $('<link id="'+id+'" href="http://fonts.googleapis.com/css?family=' + font.replace(/\s+/, '+') + '" rel="stylesheet" type="text/css" />')
                    .appendTo($('head'))
                    .load(function () {
                        $.isFunction(callback) && callback.call(that, font, $object);
                    });
            }
        },
        hideOptions: function(e){
            e.preventDefault();
            this.$('.cert-layer-options').hide();
            this.$canvas.deactivateAll().renderAll();
            this.activeObject = undefined;
            this.hideObjectControls();
        },
        _beforeSubmit: function(event){
            var $form = $(event.target),
                $input = $('input[name="cert[layers]"]', $form),
                layers = [];
            if( $input.length == 0 ){
                $input = $('<input type="hidden" name="cert[layers]" />').appendTo( $form );
            }
            _.each( this.$canvas.getObjects(), function($object){
                var objectOptions = this.getObjectOptions($object);
                if( objectOptions.flipX ){
                    objectOptions.scaleX = -objectOptions.scaleX;
                }
                if( objectOptions.flipY ){
                    objectOptions.scaleY = -objectOptions.scaleY;
                }

                layers.push(this._abc( objectOptions ));
            }, this);
            $input.val(JSON.stringify(layers));
            this.$canvas.deactivateAll().renderAll();
            $form.append( $('<input type="hidden" name="cert[preview]" value="' + this.$canvas.toDataURL() + '" />') );
        },
        _initFabric: function(){
            if( this.$canvas ) {
                this.$canvas.setHeight(this.frame.height);
                this.$canvas.setWidth(this.frame.width);
                this.$canvas.renderAll();
            }else {
                var $canvas = $('<canvas />').appendTo(this.dom.$editor),
                    that = this;
                $canvas.attr({
                    width: this.frame.width,
                    height: this.frame.height
                });
                this.$canvas = new fabric.Canvas($canvas.get(0), this.options.layers);

                this.$canvas.on({
                    'object:selected': this.onObjectSelected,
                    'object:moving': this.onObjectMoving,
                    'object:rotating': this.onObjectRotating,
                    'mouse:up': this.onObjectMouseup,
                    'mouse:down': this.onObjectMousedown,
                    'before:selection:cleared': this.onBeforeSelectionCleared
                }).observe("object:scaling", this.limitObjectScale);

                fabric.Image.fromURL( this.options.url, function(img) {
                    that.$canvas.backgroundImage = img;
                    that.$canvas.backgroundImage.width = that.frame.width;
                    that.$canvas.backgroundImage.height = that.frame.height;
                });
                _.each(this.options.layers, function(layer){
                    if( ! layer.type ) return;
                    layer = this._def(layer);
                    this.addLayer(layer);
                }, this);


                this.$('.cert-editor').css('width', this.$canvas.width);
                //this.$canvas.setActiveObject ($object);
                //this.$canvas.moveTo( $object, $object.index );

                this.canvasLoaded = true;

            }
        },
        _dragField: function(event, ui){
            _.defer(function(app, event, ui){
                var drop = ui.helper.data('drop')
                if( ! drop ) return;
                var dropPosition = drop.offset()
                app.dom.lines.$x.css({
                    left: ui.offset.left - dropPosition.left + 4
                });
                app.dom.lines.$y.css({
                    top: ui.offset.top - dropPosition.top - 1
                })
            }, this, event, ui);
        },
        _dropOver: function(event, ui){
            _.defer(function(app, event, ui){
                var drop = app.dom.$editor.addClass('drop-over').data('drag', ui.draggable);
                ui.draggable.data('drop', drop);
                app.showLines();
            }, this, event, ui);
        },
        _dropOut: function(event, ui){
            _.defer(function(app, event, ui){
                app.dom.$editor.removeClass('drop-over').data('drag', false);
                ui.draggable.data('drop', false);
                app.hideLines();
            }, this, event, ui);
        },
        _dropField: function(event, ui){
            _.defer(function(app, event, ui){
                app.hideLines();
                var field = ui.draggable.data('field'),
                    offset = app.dom.$editor.offset();

                var $newLayer = app.addLayer({
                    field: field,
                    type: 'text',
                    text: ui.draggable.text().replace(/\n/g, '').trim(),
                    top: parseInt( ui.offset.top - offset.top ),
                    left: parseInt( ui.offset.left - offset.left + 4 )
                });
                app.$canvas.setActiveObject($newLayer);
                app.loadObjectSettings($newLayer);
                app.activeObject = $newLayer;
            }, this, event, ui);
        },
        showLines: function(position){
            position = $.extend({left: 0, top: 0}, position);
            this.dom.lines.$x.show().css({left: position.left});
            this.dom.lines.$y.show().css({top: position.top});
            this.dom.$position.show().html('x: ' + parseInt(position.left) + ', y: ' + parseInt(position.top));
            this.dom.$position.css({top: position.top - this.dom.$position.outerHeight(), left: position.left + 1})
        },
        hideLines: function(){
            this.dom.lines.$x.hide();
            this.dom.lines.$y.hide();
            this.dom.$position.hide();
        },
        initDesigner: function(){
            _.defer(function(app){
                var t = new Image();
                t.src = app.dom.$cert.attr('src')
                app.frame.width = app.dom.$cert.width();
                app.frame.height = app.dom.$cert.height();
                app.frame.ratio = app.dom.$cert.width() / t.width;
                app._initFabric();
                $(window).bind('resize.cert', app.onResize).trigger('resize.cert');
            }, this)
        },
        addLayer: function(args){
            var $object = this.createLayer(args);
            this.$canvas.add($object);
            _.each(args, function(v, k){
                $object.set(k, v);
            });
            this.$canvas.renderAll();
            return $object;
        },
        createLayer: function(args){
            var defaults = {
                    fontSize: 24,
                    left: 0,
                    top: 0,
                    lineHeight: 1,
                    originX: 'left',
                    fontFamily: 'Helvetica',
                    name: this.uniqueId()
                },
                text = args.text || '',
                $object = new fabric.Text( text , $.extend(defaults, args) );
            $object.set({
                borderColor: '#333333',
                connerFill: '#FFb600',
                cornerColor: '#333333',
                cornerSize: 11,
                transparentCorners: false
            });
            $object.selectable = true;
            return $object;
        },
        getObjectOptions: function( $object ){
            var _options = {};
            /*$('select, input', this.$('.cert-options')).each(function(){
                var name = $(this).attr('name');
                _options[name] = this.value;
            });*/

            //var s = '';
            for(var i in $object){
                if(_.isString(i) && i.match(/^__x_/)) {
                    _options[i] = isNaN( $object[i] ) ? $object[i] : this.toFixed($object[i]);
                }
            }
            var options = $.extend( _options, $object.toJSON() );
            //console.log(s);
            options.field = $object.field;
            return options;
        },
        _abc: function(options){
            options = $.extend({}, options);
            _.each(['top', 'left', 'fontSize'], function(n){
                if( options[n] ){
                    options[n] = options[n] / this.frame.ratio;
                }
            }, this);
            return options;
        },
        _def: function(options){
            options = $.extend({}, options);
            _.each(['top', 'left', 'fontSize'], function(n){
                if( options[n] ){
                    options[n] = options[n] * this.frame.ratio;
                }
            }, this);
            return options;
        },
        uniqueId: function(){
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }
            return s4() + s4() + s4() + s4();
        }
    });
    $.fn.CertificateDesigner = function(options){
        return this.each(function(){
            new CertificateDesigner($.extend( certificateDesigner, {element: this} ) );
        })
    }
    $(document).ready(function(){
        $('#certificate').CertificateDesigner();
    })
})(jQuery);