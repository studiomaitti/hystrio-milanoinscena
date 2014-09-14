<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>
<div id="primary" class="site-content">
    <div id="content" role="main">
<?php 
while (have_posts()) : the_post();
    $id_spettacolo=$post->ID;
    $oTeatro=get_field('teatro');

    $oDate_da= DateTime::createFromFormat('Ymd', get_field('data_da'));
    $data_da =$oDate_da->format('d-m-Y');

    $oDate_a= DateTime::createFromFormat('Ymd', get_field('data_a'));
    $data_a =$oDate_a->format('d-m-Y');
    $now = new DateTime($now);
    if($oDate_da->format("U")<=$now->format("U") && $oDate_a->format("U")>=$now->format("U")){
        $s_status_slug='in-corso';
        $s_status_text='In Corso';
    } elseif($oDate_da->format("U")>$now->format("U")){
        $s_status_slug='futuro';
        $s_status_text='Futuro';
    } else{
        $s_status_slug='terminato';
        $s_status_text='Terminato';
    }



    $voto=get_field('voto');
    $spettacolo_orari=get_field('spettacolo_orari');
    $spettacolo_prezzi=get_field('spettacolo_prezzi');
    $gallery_photo=get_field('gallery_photo');
    
    //*************************************************************
    //AUTORE
    $terms = get_the_terms( $post->ID, 'autore' );	
    if ( $terms && ! is_wp_error( $terms ) ){
	$aterms = array();
	foreach ( $terms as $term ) { $aterms[] = $term->name; }
        if(count($aterms)>1){
            $last=array_pop( $aterms );
            $autore = join( ", ", $aterms ).' e '.$last;
        } else {
            $autore = $aterms[0];
        }
    }
    
    //*************************************************************
    //REGIA
    $terms = get_the_terms( $post->ID, 'regia' );
    if ( $terms && ! is_wp_error( $terms ) ){
	$aterms = array();
	foreach ( $terms as $term ) { $aterms[] = $term->name; }
        if(count($aterms)>1){
            $last=array_pop( $aterms );
            $regia = join( ", ", $aterms ).' e '.$last;
        } else {
            $regia = $aterms[0];
        }
    }    
    
    //*************************************************************
    //CAST
    $terms = get_the_terms( $post->ID, 'cast' );	
    if ( $terms && ! is_wp_error( $terms ) ){
	$aterms = array();
	foreach ( $terms as $term ) { $aterms[] = $term->name; }
        if(count($aterms)>1){
            $last=array_pop( $aterms );
            $cast = join( ", ", $aterms ).' e '.$last;
        } else {
            $cast = $aterms[0];
        }
    }
    
    //*************************************************************
    //PRODUZIONE
    $terms = get_the_terms( $post->ID, 'produzione' );	
    if ( $terms && ! is_wp_error( $terms ) ){
	$aterms = array();
	foreach ( $terms as $term ) { $aterms[] = $term->name; }
        if(count($aterms)>1){
            $last=array_pop( $aterms );
            $produzione = join( ", ", $aterms ).' e '.$last;
        } else {
            $produzione = $aterms[0];
        }
    }
    
?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <div class="colonna-dx">
<?php
$args_teatro=array( 'post_type'=>'teatro', 'post__in' => array( $oTeatro->ID ) );
$the_query = new WP_Query( $args_teatro );

if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $id_teatro=$post->ID;
        $indirizzo=get_field('indirizzo');
        $telefono=get_field('telefono');
        $sito_internet=get_field('sito_internet');
        $sito_internet_vis=get_field('sito_internet_vis');
        if(!$sito_internet_vis)$sito_internet_vis=$sito_internet;
        $acquisto_online=get_field('acquisto_online');
        $teatro_orari=get_field('teatro_orari');
        $teatro_prezzi=get_field('teatro_prezzi');
        
        if($spettacolo_orari) $teatro_orari=$spettacolo_orari;
        if($spettacolo_prezzi)$teatro_prezzi=$spettacolo_prezzi;
?>
<?php 
//https://www.google.com/maps/dir/Via+L.+da+Vinci,+44,+Cormano+MI,+Italy/Via+Rivoli,+6,+Milano,+Italy/
?>
<script>
    jQuery(document).ready(function(){
        jQuery('#calcola-percorso').submit(function(e) {
            e.preventDefault();
            var href = 'https://www.google.com/maps/dir/'+ jQuery('#calcola-percorso #ind-da').val() +'/<?php echo $indirizzo; ?>+Italy/';
            var tweet_popup = window.open(href, 'calcola_percorso', '');
        });
        
        var opened=false;
        jQuery('.gallery_photo_title').click(function(e){
            if(!opened){
                opened=true;
                jQuery('.gallery_photo_title span').html('-');
            } else {
                opened=false;
                jQuery('.gallery_photo_title span').html('+');
            }
            jQuery('.gallery_photo').slideToggle();
        });
    });
</script>
                        <div class="titolo-teatro">
                            <a href="<?php the_permalink(); ?>" target="_blank">Teatro: <?php the_title(); ?></a>
                        </div>
                        <div class="data"><span>dal:</span> <?php echo $data_da;?> <span>al:</span> <?php echo $data_a;?></div>
                        <div class="in-corso-i in-corso-<?php echo $s_status_slug;?>">
                            <?php echo $s_status_text;?>
                        </div>

                        <?php if($indirizzo): ?><div class="indirizzo"><?php echo $indirizzo; ?></div><?php endif; ?>
                        <?php if($telefono): ?><div class="telefono"><span>Tel: </span><?php echo $telefono; ?></div><?php endif; ?>
                        <?php if($teatro_orari): ?><div class="teatro_orari"><span>Orari: </span><?php echo $teatro_orari; ?></div><?php endif; ?>
                        <?php if($teatro_prezzi): ?><div class="teatro_prezzi"><span>Prezzi: </span><?php echo $teatro_prezzi; ?> &euro;</div><?php endif; ?>
                        <?php if($sito_internet_vis): ?><div class="sito_internet"><a href="<?php echo $sito_internet; ?>" target="_blank"><?php echo $sito_internet_vis; ?></a></div><?php endif; ?>
                        <?php if($acquisto_online): ?><div class="acquisto_online"><a href="<?php echo $acquisto_online; ?>">acquista online il biglietto</a></div><?php endif; ?>

<?php
    }
}
wp_reset_postdata();
?>                  
                        <div class="calcola-percorso">
                            <h3>Calcola percorso</h3>
                            <form action="#" method="GET" name="calcola-percorso" id="calcola-percorso">
                                <div class="f">
                                    <label>Da</label>
                                    <input type="text" name="ind-da" id="ind-da" />
                                </div>
                                <div class="f">
                                    <input type="submit" name="calcola" id="calcola" value="calcola" />
                                </div>
                                
                            </form>
                        </div>
                    </div>                    

                    <div class="colonna-sx">
                        <header class="entry-header">
                            <h1 class="entry-title"><span>SCHEDA SPETTACOLO:</span> <?php the_title(); ?></h1>
                        </header><!-- .entry-header -->
                        <?php if( $autore || $regia || $cast || $produzione):?>
                            <div class="lista-feture">
<?php if ( has_post_thumbnail() ): ?>
                                <div class="thumbnail">
                                    <?php the_post_thumbnail('220x999'); ?>
                                </div>
<?php endif; ?>

                                <?php if( $autore ):?><div class="feture autore"><span>Di </span><?php echo $autore; ?></div><?php endif; ?>
                                <?php if( $regia ):?><div class="feture regia"><span>Regia di </span><?php echo $regia; ?></div><?php endif; ?>
                                <?php if( $cast ):?><div class="feture cast"><span>Cast </span><?php echo $cast; ?></div><?php endif; ?>
                                <?php if( $produzione ):?><div class="feture produzione"><span>Una Coproduzione </span><?php echo $produzione; ?></div><?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="recensore-voto">
                            <?php if(get_the_author_meta( 'ID' )>=3): ?>
                            <span class="recensore">Recensione di: <?php echo get_the_author(); ?></span>
                            <?php endif; ?>
                            
                            <span class="voto-i voto-<?php echo str_replace('.', '_', $voto);?>">Voto <?php echo $voto;?></span>
                        </div>
                        
                        <div class="content">
                            <?php the_content(); ?>
                        </div>
                        
<?php if($gallery_photo):?>
                        <div class="gallery_photo_title">GUARDA LA GALLERY <span>+</span></div>
                        <div class="gallery_photo"><?php echo $gallery_photo; ?></div>
<?php endif; ?>
                    </div>
                </div><!-- .entry-summary -->

                <footer class="entry-meta stagione">

                </footer><!-- .entry-meta -->
            </article><!-- #post -->



        <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>