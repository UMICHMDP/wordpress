;(function ($) {
	var Certificate = window.Certificate = {
		View : null,
		Model: null
	}

	Certificate.Model = Backbone.Model.extend({});
	Certificate.View = Backbone.View.extend({
		events                  : {
			'click .learn-press-select-template-button': '_selectTemplate',
			'click .cert-design-field'                 : '_addLayer',
			'click #learn-press-close-settings-panel'  : '_closeSettings',
			'click .cert-design-delete-layer'          : '_deleteLayer'
		},
		el                      : '#learn-press-cert-wrap',
		viewport                : {
			width         : 0,
			height        : 0,
			templateWidth : 0,
			templateHeight: 0,
			ratio         : 1
		},
		model                   : null,
		systemFonts             : ['Arial', 'Georgia', 'Helvetica', 'Verdana'],
		initialize              : function (model) {
			_.bindAll(this,
				'_selectTemplate', '_onLoadTemplate', '_addLayer', '_initViewport', '_updateViewport', 'updateViewport',
				'_beforeSubmit', '_onOptionChanged', '_closeSettings', '_deleteLayer',
				'onObjectRotating',
				'onObjectRotating',
				'onObjectSelected',
				'onObjectMoving',
				'onObjectMousedown',
				'onObjectMouseup',
				'onBeforeSelectionCleared',
				'limitObjectScale',
				'onObjectModified',
				'showControls'
			);
			this.model = model;
			this._load();
		},
		_closeSettings          : function () {
			this.$('#cert-design-tools').removeClass('hide-if-js')
			this.$('#cert-design-field-settings').addClass('hide-if-js').removeClass('cert-ajaxload');
			this.$canvas.deactivateAll().renderAll();
		},
		_load                   : function () {
			var elements = this.elements = {
				viewport  : $.proxy(function () {
					return this.$('#cert-design-viewport')
				}, this),
				background: $.proxy(function () {
					var $tmpl = this.$('img.cert-template');
					if ($tmpl.length == 0) {
						$tmpl = $('<img class="cert-template" />').appendTo(this.elements.viewport());
					}
					return $tmpl;
				}, this)
			}
			elements.background().load(this._onLoadTemplate).trigger('load');
			$('form#post').submit(this._beforeSubmit);
			$(window).on('resize.learn-press-cert-designer', this._updateViewport);
			$('#cert-design-field-settings').on('change', 'input, select', this._onOptionChanged);
		},
		_onOptionChanged        : function (e) {
			var $set = $(e.target).closest('#cert-design-field-settings'),
				modelId = $set.attr('data-model-id'),
				optionName = $(e.target).attr('name'),
				$layer = this.findLayer(modelId);
			this.setLayerProp($layer, optionName, e.target.value);
			this.$canvas.renderAll();

		},
		setLayerProp            : function ($layer, prop, value) {
			var options = {};
			switch (prop) {
				case 'textAlign':
					$layer.originX = value;
					break;
				case 'color':
					$layer.set('fill', value);
					break;
				case 'scaleX':
				case 'scaleY':
					if (value < 0) {
						if (prop == 'scaleX') {
							$layer.flipX = true;
						} else {
							$layer.flipY = true;
						}
					} else {
						if (prop == 'scaleX') {
							$layer.flipX = false;
						} else {
							$layer.flipY = false;
						}
					}
					options[prop] = this.toFixed(Math.abs(value));
					break;
				case 'fontFamily':
					if (value.match(/^::/)) {
						this.loadGoogleFont(value.replace(/^::/, ''), $layer, function (font, $object) {
							if (!$object) $object = this.$canvas.getActiveObject();
							$object.set('fontFamily', font);
							setTimeout($.proxy(function () {
								this.$canvas.renderAll();
							}, this), 450)
						})
						break;
					}
				default:
					//if( $layer.attr('type') == 'number') {
					//	options[prop] = this.toFixed(value);
					//}else{
					options[prop] = value;
				//}
			}
			_.each(options, function (v, k) {
				$layer.set(k, v)
			})
			$layer.setCoords();
		},
		findLayer               : function (id) {
			var $layers = this.$canvas.getObjects(),
				$find = null;
			for (var i = 0, n = $layers.length; i < n; i++) {
				if ($layers[i].name == id) {
					$find = $layers[i];
					break;
				}
			}
			return $find;
		},
		_updateViewport         : function () {
			this._updateViewportTimeout && clearTimeout(this._updateViewportTimeout);
			this._updateViewportTimeout = setTimeout(this.updateViewport, 300);
		},
		_selectTemplate         : function (e) {
			e.preventDefault();
			var that = this;
			mediaSelector.open({
				multiple: false,
				onSelect: function (source) {
					var $tmpl = that.elements.background();
					//that.$('input[name="cert[id]"]').val(source.id);
					if (source.sizes) {
						$tmpl.attr('src', source.sizes.full.url)
					} else {
						$tmpl.attr('src', source.url)
					}
					that.$el.addClass('has-template');
					that._initViewport();
					that.$canvas.renderAll();
				}
			})
		},
		_onLoadTemplate         : function (e) {
			var tester = new Image(),
				$img = this.elements.background();
			tester.src = $img.attr('src');
			this.viewport = {
				width         : $img.width(),
				height        : $img.height(),
				templateWidth : tester.width,
				templateHeight: tester.height,
				ratio         : $img.width() / tester.width
			}
			this.model.set('template', tester.src);
			this._initViewport();
		},
		_initViewport           : function () {
			var that = this;
			if (!this.$canvas) {
				var $canvas = $('<canvas />').appendTo(this.elements.viewport());
				this.$canvas = new fabric.Canvas($canvas.get(0), this.model.get('layers'));
				this.$canvas.on({
					'object:selected'         : this.onObjectSelected,
					'object:moving'           : this.onObjectMoving,
					'object:rotating'         : this.onObjectRotating,
					'mouse:up'                : this.onObjectMouseup,
					'mouse:down'              : this.onObjectMousedown,
					'before:selection:cleared': this.onBeforeSelectionCleared,
					'object:modified'         : this.onObjectModified
				}).observe("object:scaling", this.limitObjectScale);

				_.each(this.model.get('layers'), function (layer) {
					if (!layer.type) return;
					var $layer = this.addLayer(layer, {setActive: false}),
						fontFamily = $layer.fontFamily;
					// only update font if it is not a system font
					if ($.inArray(fontFamily, this.systemFonts) == -1) {
						fontFamily = "::" + fontFamily;
						this.setLayerProp($layer, 'fontFamily', fontFamily)
					}
				}, this);
			}
			this.model.get('template') && fabric.Image.fromURL(this.model.get('template'), function (img) {
				that.$canvas.backgroundImage = img;
				$(window).trigger('resize.learn-press-cert-designer');
				that.$canvas.renderAll();
			});
		},
		_addLayer               : function (e) {
			e.preventDefault();

			var $target = $(e.target);
			if (!$target.is('span')) {
				return;
			}
			var $field = $target.closest('.cert-design-field'),
				args = {
					text     : $field.find('a').text(),
					fieldType: $field.attr('data-field')
				},
				$layer = this.createLayer(args);
			this.addLayer($layer);
			$layer.center();
			$layer.setCoords();
			this.$canvas.calcOffset();
			this.$canvas.renderAll();
			return $layer;
		},
		_deleteLayer: function(){
			if (this.$canvas.getActiveObject()) {
				this.$canvas.remove(this.$canvas.getActiveObject());
				this.hideControls();
			}
		},
		_beforeSubmit           : function (event) {
			var $form = $(event.target),
				$input = $('input[name="learn-press-cert[layers]"]', $form),
				layers = [];
			if ($input.length == 0) {
				$input = $('<input type="hidden" name="learn-press-cert[layers]" />').appendTo($form);
			}
			_.each(this.$canvas.getObjects(), function ($object) {
				var layerOptions = this.getLayerOptions($object);
				if (layerOptions.flipX) {
					layerOptions.scaleX = -layerOptions.scaleX;
				}
				if (layerOptions.flipY) {
					layerOptions.scaleY = -layerOptions.scaleY;
				}
				//layerOptions = this.removeUnwantedProp(layerOptions);
				layers.push(layerOptions);
			}, this);
			$input.val(JSON.stringify(layers));
			this.$canvas.deactivateAll().renderAll();

			this.elements.viewport().find('.canvas-container').css('opacity', 0);
			this.elements.background().css('opacity', 1);

			this.$canvas.setZoom(1);
			this.$canvas.setHeight(this.viewport.templateHeight);
			this.$canvas.setWidth(this.viewport.templateWidth);

			$form.append($('<input type="hidden" name="learn-press-cert[template]" value="' + this.model.get('template') + '" />'));
			$form.append($('<input type="hidden" name="learn-press-cert[preview]" value="' + this.$canvas.toDataURL({
					format    : 'jpeg',
					quality   : 1,
					width     : this.viewport.templateWidth,
					height    : this.viewport.templateHeight,
					multiplier: 1
				}) + '" />'));
		},
		toFixed                 : function (num) {
			return Math.ceil(num * 10) / 10;
		},
		removeUnwantedProp      : function (obj) {
			var obj2 = {};
			for (var i in obj) {
				if (obj[i] != null && obj[i] != '') {
					obj2[i] = obj[i];
				}
			}
			return obj2;
		},
		updateViewport          : function () {
			var $img = this.elements.background();
			this.viewport = $.extend(this.viewport, {
				width : $img.width(),
				height: $img.height(),
				ratio : $img.width() / this.viewport.templateWidth
			});

			//this.$canvas.backgroundImage.width = this.viewport.width;
			//this.$canvas.backgroundImage.height = this.viewport.height;

			this.$canvas.setHeight(this.viewport.height);
			this.$canvas.setWidth(this.viewport.width);

			this.$canvas.setZoom(this.viewport.ratio);
			this.$canvas.calcOffset();
			this.$canvas.renderAll();

		},
		createLayer             : function (args) {
			var defaults = $.extend({
					fontSize  : 24,
					left      : 0,
					top       : 0,
					lineHeight: 1,
					originX   : 'left',
					fontFamily: 'Helvetica',
					name      : this.uniqueId(),
					fieldType : 'custom'
				}, args),
				text = args.text || '',
				$object = new fabric.Text(text, defaults);
			$object.set({
				borderColor       : '#AAA',
				cornerColor       : '#666',
				cornerSize        : 7,
				transparentCorners: true,
				padding           : 0
			});
			_.each(defaults, function (v, k) {
				$object.set(k, v);
			});
			return $object;
		},
		addLayer                : function ($layer, args) {
			args = $.extend({
				setActive: true
			}, args || {});
			if ($.isPlainObject($layer)) {
				$layer = this.createLayer($layer);
			}
			this.$canvas.add($layer);
			if (args.setActive) {
				this.$canvas.setActiveObject($layer);
			}
			this.$canvas.renderAll();
			return $layer;
		},
		showLines               : function (position) {
			position = $.extend({left: 0, top: 0}, position);
			this.$('#cert-design-line-vertical').show().css({left: position.left});
			this.$('#cert-design-line-horizontal').show().css({top: position.top});
			//this.dom.$position.show().html('x: ' + parseInt(position.left) + ', y: ' + parseInt(position.top));
			//this.dom.$position.css({top: position.top - this.dom.$position.outerHeight(), left: position.left + 1})
		},
		hideLines               : function () {
			this.$('.cert-design-line').hide();
		},
		showControls            : function (e) {
			this.hideControls();
			var btnLeft = e.target.oCoords.mt.x;
			var btnTop = e.target.oCoords.mt.y - 25;
			var widthadjust = e.target.width / 2;
			btnLeft = widthadjust + btnLeft - 10;
			var deleteBtn = $('<p" class="cert-design-delete-layer" title="Delete" title="Remove object">&#10005;</p>').css({
				top : btnTop,
				left: btnLeft
			});
			this.$(".canvas-container").append(deleteBtn);
		},
		hideControls            : function () {
			this.$(".canvas-container .cert-design-delete-layer").remove();
		},
		onObjectSelected        : function (e) {
			var that = this;
			this.$('#cert-design-tools').addClass('hide-if-js');
			this.$('#cert-design-field-settings').attr('data-model-id', e.target.name).removeClass('hide-if-js').addClass('cert-ajaxload').find('ul').slideUp();
			this.$('.field-options-header span:eq(1)').html(e.target.text);
			this.$canvas.bringToFront(e.target);
			setTimeout( function(){
				that.showControls(e);
			}, 500);
			$.ajax({
				url     : ajaxurl,
				dataType: 'text',
				data    : {
					action: 'learn-press-cert-load-field',
					field : this.getLayerOptions(e.target),
					nonce : ''
				},
				success : function (response) {
					that.$('#cert-design-field-settings').removeClass('cert-ajaxload').find('ul').html(response).slideDown()
				}
			});
		},
		onObjectMoving          : function (event) {
			var $object = event.target;
			this.showLines({top: $object.top * this.viewport.ratio, left: $object.left * this.viewport.ratio - 1});
			this.hideControls();
		},
		onObjectRotating        : function () {
			var $object = this.$canvas.getActiveObject(),
				angle = this.toFixed($object.angle);
			this.$('input[name="angle"]').val(angle).siblings('.cert-option-slider').slider('option', 'value', angle);
			this.hideLines();
		},
		onObjectMouseup         : function () {
		},
		onObjectMousedown       : function () {
		},
		onBeforeSelectionCleared: function () {
			this.$('#cert-design-tools').removeClass('hide-if-js')
			this.$('#cert-design-field-settings').addClass('hide-if-js').removeClass('cert-ajaxload');
			this.hideLines();
			this.hideControls();
		},
		onObjectModified        : function (e) {
			this.showControls(e);
		},
		limitObjectScale        : function () {
			var $object = this.$canvas.getActiveObject(),
				scaleX = this.toFixed($object.scaleX),
				scaleY = this.toFixed($object.scaleY);
			if ($object.flipX) {
				scaleX = -scaleX;
			}
			if ($object.flipY) {
				scaleY = -scaleY;
			}
			this.$('input[name="scaleX"]').val(scaleX).siblings('.cert-option-slider').slider('option', 'value', scaleX);
			this.$('input[name="scaleY"]').val(scaleY).siblings('.cert-option-slider').slider('option', 'value', scaleY);
		},
		uniqueId                : function () {
			function s4() {
				return Math.floor((1 + Math.random()) * 0x10000)
					.toString(16)
					.substring(1);
			}

			return s4() + s4() + s4() + s4();
		},
		getExtendedFields       : function () {
			return ['name', 'fieldType', 'display', 'customText']
		},
		getLayerOptions         : function ($layer) {
			return $layer.toObject(this.getExtendedFields());
		},
		loadGoogleFont          : function (font, $object, callback) {
			var that = this,
				id = 'google-font-' + font.replace(/\s+/, '-').toLowerCase(),
				$link = $('link#' + id);
			if ($link.length) {
				$.isFunction(callback) && callback.call(that, font, $object);
			} else {
				$link = $('<link id="' + id + '" href="http://fonts.googleapis.com/css?family=' + font.replace(/\s+/, '+') + '" rel="stylesheet" type="text/css" />')
					.appendTo($('head'))
					.load(function () {
						$.isFunction(callback) && callback.call(that, font, $object);
					});
			}
		}
	});
	var mediaSelector = {
		__onSelect : null,
		__multiple : false,
		activeFrame: false,
		frame      : function (multiple) {
			multiple = typeof multiple == 'undefined' ? 0 : ( multiple ? 1 : 0)
			if (!this._frame) {
				this._frame = [];
			}
			if (!this._frame[multiple]) {
				this._frame[multiple] = wp.media({
					title   : 'Select Media',
					button  : {
						text: 'Insert'
					},
					multiple: multiple ? true : false
				});


				this._frame[multiple].state('library').on('select', this.select);
			}
			return this._frame[multiple];
		},

		select: function () {

			if ($.isFunction(mediaSelector.__onSelect)) {
				var source = this.get('selection')

				if (!mediaSelector.__multiple) {
					source = source.single().toJSON();
				} else {

					source = source.toJSON();

				}
				mediaSelector.__onSelect.call(mediaSelector._frame, source);
				mediaSelector.__onSelect = null;
			}
		},
		open  : function (args) {
			args = $.extend({
				multiple: false,
				onSelect: function () {
				}
			}, args || {});
			if ($.isFunction(args.onSelect)) {
				mediaSelector.__onSelect = args.onSelect;
				mediaSelector.__multiple = args.multiple;
				var f = mediaSelector.frame(args.multiple);
				f.open();
			}
		}
	};
})(jQuery);