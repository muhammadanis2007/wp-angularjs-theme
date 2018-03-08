<?php function ingmidwest_scripts()
{
    /*Load all styles*/
  
  //  wp_localize_script( 'wp-api', 'wpApiSettings', array( 'root' => esc_url_raw( rest_url() ), 'nonce' => wp_create_nonce( 'wp_rest' ) ) );
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style('jquery.toolbar-style', get_bloginfo('template_directory').'/css/jquery.toolbar.css', array(), null, false);
    wp_enqueue_style('animate-style', get_bloginfo('template_directory').'/css/animate.css', array(), null, false);
    
  /*  wp_register_script('require',  get_bloginfo('template_directory').'/js/require.js', array(), null, false);
    wp_enqueue_script('require',  get_bloginfo('template_directory').'/js/require.js', array(), null, false);*/
    /*Load all scripts */ 
    wp_deregister_script('wpcf7_enqueue_scripts');
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery',  get_bloginfo('template_directory').'/js/jquery-3.2.1.min.js', array(), null, false);
    wp_enqueue_script('jquery-migrate', get_bloginfo('template_directory').'/js/jquery-migrate-3.0.0.min.js', array(), null, false);
    
    wp_enqueue_script('JSing', get_bloginfo('template_directory').'/js/ing-custom-scripts.js', array(), null, false);
    wp_enqueue_script('jquery.toolbar', get_bloginfo('template_directory').'/js/jquery.toolbar.min.js', array(), null, false);

    wp_register_script('jquery',  get_bloginfo('template_directory').'/js/jquery-3.2.1.min.js', array(), null, false);
    wp_register_script('jquery-migrate', get_bloginfo('template_directory').'/js/jquery-migrate-3.0.0.min.js', array(), null, false);
    wp_register_script('jquery.toolbar', get_bloginfo('template_directory').'/js/jquery.toolbar.min.js', array(), null, false);
  
    

    wp_register_script('angular-core', get_bloginfo('template_directory').'/js/angular.min.js', array(), null, false);
    wp_register_script('angular-route', get_bloginfo('template_directory').'/js/angular-route.min.js', array(), null, false);
    wp_register_script('angular-ngSanitize', get_bloginfo('template_directory').'/js/angular-sanitize.min.js', array(), null, false);
    wp_register_script('angular-animate', get_bloginfo('template_directory').'/js/angular-animate.min.js', array(), null, false);
    
   
    wp_register_script('angular-scroll', get_bloginfo('template_directory').'/js/angular-scroll.min.js', array(), null, false);
    wp_register_script('angular-parallax', get_bloginfo('template_directory').'/js/angular-parallax.min.js', array(), null, false);
    wp_register_script('preloadjs', get_bloginfo('template_directory').'/js/preloadjs-0.4.1.min.js', array(), null, false);
    wp_register_script('TweenMax', get_bloginfo('template_directory').'/js/TweenMax.min.js', array(), null, false);
    wp_register_script('ui-bootstrap-tpls', get_bloginfo('template_directory').'/js/ui-bootstrap-tpls-0.11.0.min.js', array(), null, false);
   
   
    wp_register_script('JSing', get_bloginfo('template_directory').'/js/ing-custom-scripts.js', array(), null, false);
   
    wp_register_script('angular-app', get_bloginfo('template_directory').'/app.js', array(), null, false);
    wp_localize_script('angular-app', 'wpApiSettings', array('root' => esc_url_raw( rest_url() ), 'nonce' => wp_create_nonce( 'wp_rest' )) );
    wp_localize_script('angular-app', 'appPartials', array('proot' => get_bloginfo('template_directory')."/partials" ) );
    wp_localize_script('angular-app', 'appScripts', array('jsroot' => get_bloginfo('template_directory')."/js" ) );


    function footerscript()
	{
      
        wp_enqueue_script('angular-core');
        wp_enqueue_script('angular-route');
        wp_enqueue_script('angular-ngSanitize');
        wp_enqueue_script('angular-animate');
        wp_enqueue_script('TweenMax');
        wp_enqueue_script('angular-scroll');
        wp_enqueue_script('angular-parallax');
        wp_enqueue_script('preloadjs');
        wp_enqueue_script('ui-bootstrap-tpls');
        
 		wp_enqueue_script('angular-app');	
             
       /// add_action('wp_footer', 'footerscript');
 	}
  
	add_action('wp_footer', 'footerscript');
}

add_action('wp_enqueue_scripts', 'ingmidwest_scripts');

?>