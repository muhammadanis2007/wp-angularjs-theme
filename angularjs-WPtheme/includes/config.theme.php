<?php

if ( ! function_exists( 'ingmidwest_theme_setup' ) ) :
    
    
        function ingmidwest_theme_setup() {
     
        /**
         * Make theme available for translation.
         * Translations can be placed in the /languages/ directory.
         */
        load_theme_textdomain( 'ingmidwesttheme', get_template_directory() . '/languages' );
     
        /**
         * Add default posts and comments RSS feed links to <head>.
         */
      //  add_theme_support( 'automatic-feed-links' );
     
        /**
         * Enable support for post thumbnails and featured images.
         */

       
        add_theme_support( 'post-thumbnails' );
      //  set_post_thumbnail_size( 300, 300 );
        add_image_size( 'featured_image', 300, 300, true);
        add_image_size( 'post-thumbnails', 320, 320);

        add_theme_support( 'custom-background' );
    
        add_theme_support( 'custom-header' );
        
        add_theme_support( 'custom-logo', array(
            'height'      => 200,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ) );
    
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    
        add_theme_support( 'title-tag' );
        /**
         * Add support for two custom navigation menus.
         */
        register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'ingmidtwesttheme' ),
            'secondary' => __('Secondary Menu', 'ingmidwesttheme' ),
            'footer' => __('Footer Menu', 'ingmidwesttheme' ),
            'mobile' => __('Mobile Menu', 'ingmidwesttheme')
        ) );
     
        /**
         * Enable support for the following post formats:
         * aside, gallery, quote, image, and video
         */
        add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
    }
    endif; // myfirsttheme_setup
    add_action( 'after_setup_theme', 'ingmidwest_theme_setup' );
    
    
    
    function ingmidwest_widgets_init() {
        register_sidebar( array(
          'name' => 'Header Sidebar',
          'id' => 'header_sidebar',
          'before_widget' => ' ',
          'after_widget' => ' ', 
          'before_title' => '<h2>', 
          'after_title' => '</h2>', ));
          register_sidebar( array(
            'name' => 'Thiner Top Left Sidebar',
            'id' => 'thiner_top_left_sidebar',
            'before_widget' => ' ',
            'after_widget' => ' ', 
            'before_title' => '<span class="widget-top">', 
            'after_title' => '</span>', ));
            register_sidebar( array(
                'name' => 'Thiner Top Right Sidebar',
                'id' => 'thiner_top_right_sidebar',
                'before_widget' => ' ',
                'after_widget' => ' ', 
                'before_title' => '<span class="widget-top">', 
                'after_title' => '<span>', ));
            register_sidebar( array(
                'name' => 'Home Slider',
                'id' => 'home_slider',
                'before_widget' => ' ',
                'after_widget' => ' ', 
                'before_title' => '', 
                'after_title' => '', ));

             register_sidebar( array(
                    'name' => 'Footer Col-a',
                    'id' => 'footer-col-a',
                    'before_widget' => ' ',
                    'after_widget' => ' ', 
                    'before_title' => '', 
                    'after_title' => '', ));
    
             register_sidebar( array(
                        'name' => 'Footer Col-b',
                        'id' => 'footer-col-b',
                        'before_widget' => ' ',
                        'after_widget' => ' ', 
                        'before_title' => '', 
                        'after_title' => '', ));      
                        
            register_sidebar( array(
                            'name' => 'Footer Col-c',
                            'id' => 'footer-col-c',
                            'before_widget' => ' ',
                            'after_widget' => ' ', 
                            'before_title' => '', 
                            'after_title' => '', ));                
                    

    
      
      }
      add_action( 'widgets_init', 'ingmidwest_widgets_init' );


/*Modify post Type post structure for post*/
     
     add_action( 'init', 'support_excerpt' );
      function  support_excerpt() {
           
        add_post_type_support( 'post', 'excerpt' );
        add_post_type_support( 'page', 'excerpt' );
      
    }

      function append_query_string( $url, $post, $leavename ) {
        if ( $post->post_type == 'post' ) {		
            $url = home_url( user_trailingslashit( "posts/$post->post_name" ) );
        }
        return $url;
    }
    add_filter( 'post_link', 'append_query_string', 10, 3 );


/* Contact Form 7 action URLs and Email sending reinitiated */

add_action('wpcf7_before_send_mail', 'my_wpcf7_choose_recipient');    
function my_wpcf7_choose_recipient($WPCF7_ContactForm)
{
    // use $submission to access POST data
    $submission = WPCF7_Submission::get_instance();
    $data = $submission->get_posted_data();
    $subject = $data['subject'];

    // use WPCF7_ContactForm->prop() to access form settings
    $mail = $WPCF7_ContactForm->prop('mail');
    $recipient = $mail['recipient'];

    // update a form property
    $WPCF7_ContactForm->set_properties(array('mail' => $mail));
}


add_filter('wpcf7_form_action_url', function($url) {

    //$url = site_url("/contact-us#wpcf7-f89-o1","relative");
    $parts = explode('=', $url);
     
    $url = site_url($parts[1], "relative");
    return $url;
    });


  ?>