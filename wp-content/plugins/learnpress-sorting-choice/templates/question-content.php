<?php
/**
 * Template for displaying the content of multi-choice question
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$quiz = LP()->quiz;
$user = LP()->user;

$completed    = $user->get_quiz_status( $quiz->id ) == 'completed';
$show_result  = $quiz->show_result == 'yes';
$checked      = $user->has_checked_answer( $this->id, $quiz->id );
$check_answer = false;

$args = array(
	'quiz' => $quiz
);
if ( $checked || ( $show_result && $completed ) ) {
	$args['classes'] = 'checked';
	$check_answer    = true;
}

$wrap_id = 'learn_press_question_wrap_' . $this->id;
?>
<div id="<?php echo $wrap_id; ?>" <?php learn_press_question_class( $this, $args ); ?> data-id="<?php echo $this->id; ?>" data-type="multi-choice">

	<?php do_action( 'learn_press_before_question_wrap', $this, $quiz ); ?>

	<h4 class="learn-press-question-title"><?php echo get_the_title( $this->id ); ?></h4>
	<?php
	if ( $origin_answers = $this->answers ) {
		$origin_ids = array_keys( $origin_answers );
	} else {
		$origin_answers = array();
		$origin_ids     = array();
	}
	?>
	<?php do_action( 'learn_press_before_question_options', $this, $quiz ); ?>
	<ul class="learn-press-question-options">
		<?php $answers = $this->get_displaying_answers( $quiz->id, LP()->user->id );
		$index         = 0; ?>
		<?php if ( $answers ) foreach ( $answers as $k => $answer ): ?>
			<?php
			$answer_class = array();
			if ( $check_answer ) {
				$origin_index = array_search( $k, $origin_ids );

				if ( $origin_index !== $index ) {
					$answer_class[] = 'user-answer-false';
					$is_true        = false;
				} else {
					$answer_class[] = 'answer-true';
					$is_true        = true;
				}
			}
			?>
			<li class="<?php echo join( ' ', $answer_class ); ?>">
				<?php do_action( 'learn_press_before_question_answer_text', $answer, $this, $quiz ); ?>

				<label>
					<input type="hidden" name="learn-press-question-<?php echo $this->id; ?>[<?php echo $k; ?>]" value="<?php echo !empty( $answer['value'] ) ? $answer['value'] : $k; ?>" />
					<?php echo apply_filters( 'learn_press_question_answer_text', $answer['text'], $answer, $this, $quiz ); ?>
				</label>

				<?php if ( $check_answer && !$is_true ) { ?>
					<div class="correct-answer-label">
						<?php printf( __( 'Correct answer: %s', 'learnpress-sorting-choice' ), @$origin_answers[$origin_ids[$index]]['text'] ); ?>
					</div>
				<?php } ?>
				<?php do_action( 'learn_press_before_question_answer_text', $answer, $this, $quiz ); ?>

			</li>
			<?php $index ++; ?>
		<?php endforeach; ?>
	</ul>
	<input type="hidden" name="learn-press-question-permalink" value="<?php echo esc_url( $quiz->get_question_link( $this->id ) ); ?>" />

	<?php do_action( 'learn_press_after_question_wrap', $this, $quiz ); ?>
	<script>
		;
		jQuery(function ($) {
			$('#<?php echo $wrap_id;?>:not(.checked) ul').sortable({
				axis: 'y'
			});
		});
	</script>
</div>

