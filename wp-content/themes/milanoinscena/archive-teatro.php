<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php 
$suffisso_titolo='';

////////////////////////////////////////////////////////////////////////
//RICERCA SPETTACOLO PER: TITOLO | AUTORE | REGIA | CAST
if(isset($_GET['ss']) && $_GET['ss']=='csp'){
    $f_titolo=sanitize_text_field($_GET['f-nome']);
    
    //TODO: aggiungere ordinamento per voto
    if($f_titolo){
        $args = array_merge( $wp_query->query_vars, array( 
                'search_prod_title'=>$f_titolo,
                'orderby'    => 'title',
                'order'      => 'ASC',
            ) );
        query_posts( $args );
    }

} else {
    $args = array_merge( $wp_query->query_vars, array(
        'orderby'    => 'title',
        'order'      => 'ASC',
    ) );
    query_posts( $args );
}

?>


	<div id="primary" class="site-content">
            <div id="content" role="main">
                <?php if ( 1==1 ) : ?>
                    <h1 class="archive-title">CERCA TEATRO<?php if($suffisso_titolo){ echo ': <span class="suffisso_titolo">'.$suffisso_titolo.'</span>'; }?></h1>
                <?php else : ?>
                    <h1 class="archive-title">SPETTACOLI</h1>
                <?php endif;  ?>                    


<?php
$aSearch=array();
if(isset($_GET['ss']) && $_GET['ss']=='csp'){
    if($_GET['f-nome']) $aSearch[]='<span class="sub.tit">Nome:</span> '.$_GET['f-nome'];
}
?>
<?php if ( have_posts() ) : ?>
        <?php twentytwelve_content_nav(); ?>
<?php endif; ?>
<?php if(isset($_GET['ss']) && $_GET['ss']=='csp' && count($aSearch)):?>
                    <div class="hai-cercato">
                        <div class="pre-title">Hai cercato:</div>
                        <?php echo implode(',',$aSearch)?>
                    </div>
<?php endif; ?>
                    
<?php if ( have_posts() ) : ?>
                    <div class="spettacoli-loop">
<?php 
    while ( have_posts() ) : the_post(); 
        $id_teatro=$post->ID;
        $indirizzo=get_field('indirizzo');
        $telefono=get_field('telefono');
        $sito_internet=get_field('sito_internet');
        $sito_internet_vis=get_field('sito_internet_vis');
        if(!$sito_internet_vis)$sito_internet_vis=$sito_internet;
        $acquisto_online=get_field('acquisto_online');
        $teatro_orari=get_field('teatro_orari');
        $teatro_prezzi=get_field('teatro_prezzi');
?>
<div class="spettacolo-i">
    <div class="spettacolo-cont">
        <div class="col-1">
            <div class="col-a">
                <h3 class="title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"  title="<?php echo esc_attr( 'Scheda Teatro: '.the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="teatro">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"  title="<?php echo esc_attr( 'Scheda Teatro: '.the_title_attribute( 'echo=0' ) ); ?>"><?php echo the_excerpt(); ?></a>
                </div>
            </div>
            <div class="col-b">
                <div class="data">
                    <span>Indirizzo</span>: <?php echo $indirizzo;?><br>
                    <span>Tel</span>: <?php echo $telefono;?>
                </div>
            </div>
        </div>
        <div class="col-2">
        </div>
        <div class="col-3">
            <a href="<?php the_permalink(); ?>" rel="bookmark"  title="<?php echo esc_attr( 'Scheda Spettacolo: '.the_title_attribute( 'echo=0' ) ); ?>" class="link-spettacolo">Scheda Spettacolo</a>
        </div>
    </div>
    <div class="data-voto-smartphone">
        <div class="data">
            <span>Indirizzo</span>: <?php echo $indirizzo;?><br>
            <span>Tel</span>: <?php echo $telefono;?>
        </div>
    </div>
</div>
<?php endwhile; ?>
</div>

		<?php else : ?>

                    <article id="post-0" class="post no-results not-found">
                        <header class="entry-header">
                            <h2 class="entry-title no-results">Nessun teatro trovato!</h2>
                        </header>
                        <div class="entry-content">
                            <p><a href="/cerca-spettacolo" title="Effettua una nuova ricerca Ricerca">Clicca qui per fare una nuova ricerca</a></p>
                        </div><!-- .entry-content -->
                    </article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>