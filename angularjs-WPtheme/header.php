<!DOCTYPE html>
<html <?php language_attributes(); ?>     >
<head>


<base href="/">



<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
 

  <title><?php bloginfo( 'name' ); ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=11,IE=edge,chrome=1">
        <meta charset="utf-8">
       
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
       

  <?php wp_head();?>
</head>
<body ng-app="idsapps" >
  


<!--Navigation Area Start from Here-->
<!--<div class="row" >
<div id="thiner_top_left_sidebar" class="col-2" ><?php  /* if (! function_exists ( 'dynamic_sidebar' ) || ! dynamic_sidebar ( 'thiner_top_left_sidebar' )) :endif;*/ ?></div>
<div id="thiner_top_right_sidebar" class="col-2 content-ra" ><?php /*  if (! function_exists ( 'dynamic_sidebar' ) || ! dynamic_sidebar ( 'thiner_top_right_sidebar' )) :endif; */ ?></div>
</div>-->

<nav class="animated fadeInDown">


<button class="menu-toggle-btn" type="button" >
<span class="fa fa-bars"></span>
</button>
<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

?>

  <div class="menu-container" >

  <a class="brand-container lf" href="<?php echo esc_url( home_url('/') ); ?>"><?php //bloginfo('name'); ?>
  <img class="site-logo responsive" src="<?php echo $image[0];?>" alt="<?php bloginfo('name'); ?>" />
  </a>

<!-- <div class="menu-widget" id="header_sidebar" ><?php //  if (! function_exists ( 'dynamic_sidebar' ) || ! dynamic_sidebar ( 'Header Sidebar' )) :endif; ?></div>-->

    <?php
      wp_nav_menu( array(
        'theme_location'	=> 'Primary Menu',
        'menu' => 'Main Menu',
        'container'       => true,
        'menu_class'		  => 'top-main-menu lf',
        'walker' => new WPDocs_Walker_Nav_Menu(),
        'items_wrap' => '<ul  id="%1$s" class="%2$s" auto-active >%3$s</ul>'
    
      ) );
    ?>


<div id="thiner_top_right_sidebar" class="lf content-ra" ><?php   if (! function_exists ( 'dynamic_sidebar' ) || ! dynamic_sidebar ( 'thiner_top_right_sidebar' )) :endif; ?></div>
   <div class="clear-f" ></div>
  </div>
 

  
</nav>




    
