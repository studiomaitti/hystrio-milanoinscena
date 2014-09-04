<?php
/**
 * Template Name: Ricerca Teatro
 * 
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=it"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/gmap3/gmap3.min.js"></script>
<script>
    jQuery(document).ready(function(){
        jQuery('.row-f label').click(function(e){
            jQuery(this).fadeOut('fast');
            jQuery('#'+jQuery(this).attr('for')).focus();
        });
        jQuery('.row-f input.form-text').focus(function(){
            l=jQuery('.row-f label[for="'+jQuery(this).attr('id')+'"]');
            if(l.css('display')!='none'){
                l.fadeOut('fast');
            }
        });
        jQuery('.row-f input.form-text').blur(function(){
            if(jQuery(this).val()==''){
                l=jQuery('.row-f label[for="'+jQuery(this).attr('id')+'"]');
                l.fadeIn('fast');
            }
        });

    });
</script>
<div id="primary" class="site-content">
    <div id="content" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <div class="cerca-spettacolo-form">
                        <h2 class="title">CERCA TEATRO</h2>
                        <form method="get" action="/teatro" name="f-cerca-spettacolo" id="f-cerca-spettacolo" class="form">
                            <input type="hidden" name="ss" value="csp">
                            <div class="row-f">
                                <label for="f-nome">Nome</label>
                                <input type="text" name="f-nome" id="f-nome" class="form-text" />
                            </div>
                            <div class="row-f row-submit">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="CERCA!" />
                            </div>                            
                        </form>
                    </div>
                    <div class="cerca-spettacolo-sel-rapida">
<?php
//RICAVO LA LISTA DI TUTTI I TEATRI
$args = array(
	'post_type' => 'teatro',
	'posts_per_page'    => '-1',
);
$the_query = new WP_Query( $args );

// The Loop
$a_map=array();
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $indirizzo=get_field('indirizzo');
        $telefono=get_field('telefono');

        $obj = new stdClass();
        $obj->address=$indirizzo;
        $obj->data='<div><strong>'.get_the_title().'</strong></div>'.
                           '<div>'.$indirizzo.'</div>'.
                           (($telefono)?'<div>Tel: '.$telefono.'</div>':'');
        $a_map[]=$obj;
    }
}
/* Restore original Post Data */
wp_reset_postdata();
?>
	<div id="mappa-teatri"></div>
<script>
jQuery(document).ready(function(){
	jQuery("#mappa-teatri").gmap3({
	  map:{
	    options:{
	      center:[45.46417,9.190557],
	      zoom: 10
	    }
	  },
	  marker:{
	    values:<?php echo json_encode($a_map); ?>,
	    options:{
	      draggable: true
	    },
	    events:{
	      click: function(marker, event, context){
	        var map = jQuery(this).gmap3("get"),
	          infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
	        if (infowindow){
	          infowindow.open(map, marker);
	          infowindow.setContent(context.data);
	        } else {
	          jQuery(this).gmap3({
	            infowindow:{
	              anchor:marker, 
	              options:{content: context.data}
	            }
	          });
	        }
	      }
	    }
	  },
	  autofit:{}
	});
});
</script>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post -->
        <?php endwhile; // end of the loop. ?>
    </div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>