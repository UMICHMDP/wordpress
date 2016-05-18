;(function ($) {
	$(document).ready(function () {
		LearnPress.Hook.addAction('learn_press_check_question', function (response, $view) {
			var $question = $view.model.current();
			if (!$question || $question.get('type') != 'sorting_choice') {
				return;
			}
			var $content = $($question.get('content')).addClass('checked');
			$content.find('.learn-press-question-options').replaceWith($(response.checked).find('.learn-press-question-options'));
			$question.set({
				content: $content
			});
		})
	});
})(jQuery);