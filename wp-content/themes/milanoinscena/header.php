<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<link href="<?php echo get_template_directory_uri(); ?>/font/avantgarde.css" rel="stylesheet" type="text/css" />
<script>
    jQuery(document).ready(function(){
        //MENU
        if(jQuery('.site-header .menu').length){
            jQuery('.site-header a.menu-link').bind('click',function(e){
                e.preventDefault();
                jQuery(this).toggleClass('opened');
                jQuery('.site-header .submenu').slideToggle();
            });
        }
    });
</script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
            <hgroup>
                <div class="social-less-600">
                    <a href="#" title="Seguici su Pinterest" class="pinterest">Pinterest</a>
                    <a href="#" title="Seguici su Facebook" class="facebook">Facebook</a>
                    <a href="#" title="Seguici su Twitter" class="twitter">Twitter</a>
                    <a href="#" title="Seguici su Youtube" class="youtube">Youtube</a>
                    <a href="#" title="Seguici su Tumbler" class="tumbler">Tumbler</a>
                    <a href="#" title="Scopri Hystrio" class="hystrio">hystrio</a>
                </div>

                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/images/logo-milanoinscena.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
                    </a>
                </h1>
                <div class="menu">
                    <a class="menu-link" href="#"></a>
                    <div class="submenu">
                        <a href="/cerca-spettacolo" title="Cerca Spettacolo" class="cerca-spettacolo">Cerca Spettacolo</a>
                        <a href="/cerca-teatro/" title="Cerca Teatro" class="cerca-teatro">Cerca Teatro</a>
                        <a href="/spettacolo/?ss=recensioni" title="Leggi gli spettacoli recensiti" class="recensioni">Recensioni</a>
                        <a href="/calendari" title="Oggi e Domani, il prossimo Weekend, per Mese" class="calendari">Calendari</a>
                    </div>
                </div>
                <div class="social">
                    <a href="#" title="Seguici su Pinterest" class="pinterest">Pinterest</a>
                    <a href="#" title="Seguici su Facebook" class="facebook">Facebook</a>
                    <a href="#" title="Seguici su Twitter" class="twitter">Twitter</a>
                    <a href="#" title="Seguici su Youtube" class="youtube">Youtube</a>
                    <a href="#" title="Seguici su Tumbler" class="tumbler">Tumbler</a>
                    <a href="#" title="Scopri Hystrio" class="hystrio">hystrio</a>
                </div>
            </hgroup>
	</header><!-- #masthead -->
<?php if(is_front_page()):?>
	<div id="main-home" class="wrapper">
<?php else: ?>
        <div id="main" class="wrapper">
<?php endif; ?>