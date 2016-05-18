;
jQuery(function ($) {
	var $stripeForm, $cardNumber, $cardExpiry, $cardCvc, $button;

	function initForm() {
		$stripeForm = $('#learn-press-checkout');
		$cardNumber = $('#learn-press-stripe-payment-card-number', $stripeForm);
		$cardExpiry = $('#learn-press-stripe-payment-card-expiry', $stripeForm);
		$cardCvc = $('#learn-press-stripe-payment-card-code', $stripeForm);
		$button = $('#learn-press-checkout[name="learn_press_checkout_place_order"]', $stripeForm);

		$stripeForm.on('change', '.learn-press-stripe-expiry', function(){
			$cardExpiry.val($('.learn-press-stripe-expiry', $stripeForm).map(function(){return this.value;}).get().join('/'));
		})
	}

	function stripeResponseHandler(status, response) {
		if (response.error) {
			LearnPress.Checkout.showErrors('<div class="learn-press-error">' + response.error.message + '</div>');
			$button.prop('disabled', false);
			$button.val($button.attr('data-value'))
		} else {
			$stripeForm.append('<input type="hidden" id="learn-press-stripe-token" class="learn-press-stripe-token" name="learn-press-stripe[token]" value="' + response.id + '"/>');
			$stripeForm.submit();
		}
	}

	function init() {
		load_libs();
		if( typeof Stripe == 'undefined' ){
			alert( 'Stripe library does not exists' );
			return;
		}
		// Set API key
		Stripe.setPublishableKey(learn_press_stripe_info.publish_key);

		initForm();
		$stripeForm.on('learn_press_checkout_place_order', function () {
			$button.prop('disabled', true);
			$button.val($button.attr('data-processing-text'))
			if ($('input[type="radio"]:checked', $stripeForm).val() == 'stripe' && !$('#learn-press-stripe-token', $stripeForm).val() ) {
				var cardExpiry = $cardExpiry.payment('cardExpiryVal'),
					stripeData = {
						number   : $cardNumber.val() || '',
						cvc      : $cardCvc.val() || '',
						exp_month: cardExpiry.month || '',
						exp_year : cardExpiry.year || '',
						name     : 'Tu Nguyen'
					};
				Stripe.createToken(stripeData, stripeResponseHandler);
				return false;
			}
			return true;
		});
		if( learn_press_stripe_info.test_mode == 'yes' ){
			$cardNumber.val( '4242424242424242' );
			$cardCvc.val(123);
		}
		$('.learn-press-stripe-expiry').trigger('change')
	}

	function load_libs() {
		if (typeof $.fn.payment == 'undefined') {
			var headTag = document.getElementsByTagName("head")[0];
			var jqTag = document.createElement('script');
			jqTag.type = 'text/javascript';
			jqTag.src = learn_press_stripe_info.plugin_url + '/assets/js/payment.js';
			headTag.appendChild(jqTag);
		}
	}

	init();
})