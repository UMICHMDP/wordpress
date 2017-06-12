<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package thim
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_attr_e('Projects not available', 'eduma'); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>

            <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'eduma'), esc_url(admin_url('post-new.php'))); ?></p>

        <?php elseif (is_search()) : ?>

            <p><?php esc_attr_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'eduma'); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php esc_attr_e('2018 projects coming soon!', 'eduma'); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
