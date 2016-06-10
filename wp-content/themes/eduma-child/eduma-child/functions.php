
<?php

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles', PHP_INT_MAX);
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parent6-style', get_template_directory_uri() . '/style-6.css' );
    wp_enqueue_style( 'parent7-style', get_template_directory_uri() . '/style-7.css' );
    wp_enqueue_style( 'parent8-style', get_template_directory_uri() . '/style-8.css' );
    wp_enqueue_style( 'parent9-style', get_template_directory_uri() . '/style-9.css' );
    wp_enqueue_style( 'parent10-style', get_template_directory_uri() . '/style-10.css' );
    wp_enqueue_style( 'parent11-style', get_template_directory_uri() . '/style-11.css' );
    wp_enqueue_style( 'parent12-style', get_template_directory_uri() . '/style-12.css' );
    wp_enqueue_style( 'parent13-style', get_template_directory_uri() . '/style-13.css' );
    wp_enqueue_style( 'parent14-style', get_template_directory_uri() . '/style-14.css' );
    wp_enqueue_style( 'parent15-style', get_template_directory_uri() . '/style-15.css' );
    wp_enqueue_style( 'parent16-style', get_template_directory_uri() . '/style-16.css' );
    wp_enqueue_style( 'parent17-style', get_template_directory_uri() . '/style-17.css' );
    wp_enqueue_style( 'parent18-style', get_template_directory_uri() . '/style-18.css' );
    wp_enqueue_style( 'parent19-style', get_template_directory_uri() . '/style-19.css' );
    wp_enqueue_style( 'parent20-style', get_template_directory_uri() . '/style-20.css' );
    wp_enqueue_style( 'parent21-style', get_template_directory_uri() . '/style-21.css' );
    wp_enqueue_style( 'parent22-style', get_template_directory_uri() . '/style-22.css' );
    wp_enqueue_style( 'parent23-style', get_template_directory_uri() . '/style-23.css' );
    wp_enqueue_style( 'parent24-style', get_template_directory_uri() . '/style-24.css' );
    wp_enqueue_style( 'parent25-style', get_template_directory_uri() . '/style-25.css' );
    wp_enqueue_style( 'parent26-style', get_template_directory_uri() . '/style-26.css' );
    wp_enqueue_style( 'parent27-style', get_template_directory_uri() . '/style-27.css' );
    wp_enqueue_style( 'parent28-style', get_template_directory_uri() . '/style-28.css' );
    wp_enqueue_style( 'parent29-style', get_template_directory_uri() . '/style-29.css' );
    wp_enqueue_style( 'parent30-style', get_template_directory_uri() . '/style-30.css' );
    wp_enqueue_style( 'parent230-style', get_template_directory_uri() . '/style-230.css' );
    wp_enqueue_style( 'rtl-style', get_template_directory_uri() . '/rtl.css' );
    wp_enqueue_style( 'comingsoon-style', get_template_directory_uri() . 'assets/css/coming-soon.css' );
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . 'assets/css/custom.css' );
   wp_enqueue_style( 'icomoon-style', get_template_directory_uri() . 'assets/css/icomoon.css' );
    wp_enqueue_style( 'import-style', get_template_directory_uri() . 'assets/css/import-icomoon.css' );
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'));
  
}

function thim_course_info() {
        global $course;
        $course_id = get_the_ID();
        
        $tags = get_the_terms( $course_id, 'course_category' );
        ?>
        <div class="thim-course-info">
            <h3 class="title"><?php esc_html_e( 'Project Features', 'eduma' ); ?></h3>
            <ul>
    
                <li>
                    <i class="fa fa-level-up"></i>
                    <span class="label"><?php esc_html_e( 'Skill level', 'eduma' ); ?></span>
                    <span class="value" style="text-align: right;"><?php echo esc_html( get_post_meta( $course_id, 'thim_course_skill_level', true ) ); ?></span>
                </li>
                <li>
                    <i class="fa fa-users"></i>
                    <span class="label"><?php esc_html_e( 'Students', 'eduma' ); ?></span>
                    <span class="value" style="text-align: right;"><?php echo esc_html( get_post_meta( $course_id, 'thim_course_duration', true ) ); ?></span>
                </li>
                <?php //thim_course_certificate( $course_id ); ?>
                
                <li>
                    <i class="fa fa-puzzle-piece"></i>
                    <span class="label"><?php esc_html_e( 'Likely Majors', 'eduma' ); ?></span>
                    <span class="value" style="text-align: right;"><?php
                     if($tags){
                        foreach ($tags as $individual_tag){
                            if ($individual_tag->description != 'NONE'){
                                $tag_ids[] = $individual_tag->description;
                            }
                        }

                    $result = implode(", ", $tag_ids);
                    echo $result;
                    }
                     ?></span>
                </li>
                <li>
                    <i class="fa fa-check-square-o"></i>
                    <span class="label"><?php esc_html_e( 'Course Substitutions', 'eduma' ); ?></span>
                    <span class="value" style="text-align: right;"><?php echo esc_html( get_post_meta( $course_id, 'thim_course_language', true ) ); ?></span>
                </li>
            </ul>
            <form>
            <INPUT style="width: 210px; height: 50px; text-align: center; border: 0px; font-weight: bold; background: #ffcb05; color: #00274c; cursor: pointer; font-size: 100%;" Type="BUTTON" Value="APPLY" Onclick="window.location.href='https://umich.qualtrics.com/SE/?SID=SV_1TViVgTbkMmTyQJ'">
            </form>
            
            
        </div>
        <?php
 }

function thim_related_courses() {
        $related_courses = thim_get_related_courses( null, array( 'posts_per_page' => 3 ) );
        if ( $related_courses ) {
            ?>
            <div class="thim-ralated-course">
                <h3 class="related-title"><?php esc_html_e( 'You May Like', 'eduma' ); ?></h3>

                <div class="thim-course-grid">
                    <?php foreach ( $related_courses as $course_item ) : ?>
                        <?php
                        $course      = LP_Course::get_course( $course_item->ID );
                        $is_required = $course->is_required_enroll();
                        ?>
                        <article class="course-grid-3 lpr_course">
                            <div class="course-item">
                                <div class="course-thumbnail">
                                    <a href="<?php echo get_the_permalink( $course_item->ID ); ?>">
                                        <?php
                                        echo thim_get_feature_image( get_post_thumbnail_id( $course_item->ID ), 'full', 450, 450, $course->post_title );
                                        ?>
                                    </a>
                                    <?php //thim_course_wishlist_button( $course_item->ID ); ?>
                                    <?php echo '<a class="course-readmore" href="' . esc_url( get_the_permalink( $course_item->ID ) ) . '">' . esc_html__( 'Read More', 'eduma' ) . '</a>'; ?>
                                </div>
                                <div class="thim-course-content">
                                    <div class="course-author">
                                        <?php //echo get_avatar( $course_item->post_author, 40 ); ?>
                                    </div>
                                    <h2 class="course-title">
                                        <a rel="bookmark" href="<?php echo get_the_permalink( $course_item->ID ); ?>"><?php echo esc_html( $course_item->post_title ); ?></a>
                                    </h2> <!-- .entry-header -->
                                    <div class="course-meta">
                                        <?php
                                        $count_student = $course->count_users_enrolled( 'append' ) ? $course->count_users_enrolled( 'append' ) : 0;
                                        ?>
                                        <?php //thim_course_ratings_count( $course_item->ID ); ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }

    

?>

