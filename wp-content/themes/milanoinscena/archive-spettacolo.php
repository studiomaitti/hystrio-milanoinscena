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
    $f_titolo=sanitize_text_field($_GET['f-titolo']);
    
    $f_autore=sanitize_text_field($_GET['f-autore']);
    if($f_autore) $f_autore=explode(' ',$f_autore);    
    $f_regia =sanitize_text_field($_GET['f-regia']);
    if($f_regia) $f_regia =explode(' ',$f_regia);    
    $f_cast  =sanitize_text_field($_GET['f-cast']);
    if($f_cast) $f_cast  =explode(' ',$f_cast);
    
    $args_s=array('relation' => 'AND');
    if($f_autore && count($f_autore)){
        $f_autore="(terms.name LIKE '%".implode("%' OR terms.name LIKE '%",$f_autore)."%' )";
        $autore_termids=$wpdb->get_col("SELECT DISTINCT(terms.term_id) 
            FROM $wpdb->terms AS terms 
            JOIN $wpdb->term_taxonomy as termtaxonomy 
            WHERE ".$f_autore." AND taxonomy='autore'"); 
        //var_dump($termids);
        $args_s[]=array(
			'taxonomy' => 'autore',
			'field' => 'id',
			'terms' => $autore_termids
		);
    }
    
    if($f_regia && count($f_regia)){
        $f_regia="(terms.name LIKE '%".implode("%' OR terms.name LIKE '%",$f_regia)."%' )";
        $regia_termids=$wpdb->get_col("SELECT DISTINCT(terms.term_id) 
            FROM $wpdb->terms AS terms 
            JOIN $wpdb->term_taxonomy as termtaxonomy 
            WHERE ".$f_regia." AND taxonomy='autore'"); 
        //var_dump($termids);
        $args_s[]=array(
			'taxonomy' => 'regia',
			'field' => 'id',
			'terms' => $regia_termids
		);
    }
    
    if($f_cast && count($f_cast)){
        $f_cast="(terms.name LIKE '%".implode("%' OR terms.name LIKE '%",$f_cast)."%' )";
        $cast_termids=$wpdb->get_col("SELECT DISTINCT(terms.term_id) 
            FROM $wpdb->terms AS terms 
            JOIN $wpdb->term_taxonomy as termtaxonomy 
            WHERE ".$f_cast." AND taxonomy='autore'"); 
        //var_dump($termids);
        $args_s[]=array(
			'taxonomy' => 'cast',
			'field' => 'id',
			'terms' => $cast_termids
		);
    }
    
    //TODO: aggiungere ordinamento per voto
    if($f_titolo){
        if(count($args_s)==1){
            $args = array_merge( $wp_query->query_vars, array( 
                'search_prod_title'=>$f_titolo,
                'meta_key'   => 'voto',
                'orderby'    => 'meta_value_num',
                'order'      => 'DESC',
            ) );
        } else {
            $args = array_merge( $wp_query->query_vars, array( 
                'search_prod_title'=>$f_titolo,
                'tax_query' => $args_s,
                'meta_key'   => 'voto',
                'orderby'    => 'meta_value_num',
                'order'      => 'DESC',
            ) );
            
        }
    } else {
        if(count($args_s)==1){
            $args = array_merge( $wp_query->query_vars, array(
                'meta_key'   => 'voto',
                'orderby'    => 'meta_value_num',
                'order'      => 'DESC',
            ) );
        } else {
            $args = array_merge( $wp_query->query_vars, array(
                'tax_query' => $args_s,
                'meta_key'   => 'voto',
                'orderby'    => 'meta_value_num',
                'order'      => 'DESC',
            ) );
            
        }
    }
    query_posts( $args );

} elseif(isset($_GET['ss']) && $_GET['ss']=='today'){
    ////////////////////////////////////////////////////////////////////////
    //RICERCA SPETTACOLO PER DATA: OGGI e DOMANI
    //TODO: filtro data_da data_a
    //La data di inizio deve essere inferiore-uguale a quella di domani 
    //La data di fine deve essere superiore-uguale a oggi
    
    $suffisso_titolo = 'Oggi e Domani';

    try {
        $date = new DateTime();
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
    $today=$date->format('Ymd');
    $date->add(new DateInterval('P1D'));
    $tomorrow=$date->format('Ymd');

    $args = array_merge( $wp_query->query_vars, array(
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'data_da',
                'value'   => $tomorrow,
                'type'    => 'DATE',
                'compare' => '<=',
            ),
            array(
                'key' => 'data_a',
                'value'   => $today,
                'type'    => 'DATE',
                'compare' => '>=',
            ),
        ),
        'meta_key'   => 'voto',
        'orderby'    => 'meta_value_num',
        'order'      => 'DESC',
    ) );
    query_posts( $args );
    
} elseif(isset($_GET['ss']) && $_GET['ss']=='weekend'){
    ////////////////////////////////////////////////////////////////////////
    //RICERCA SPETTACOLO PER DATA: WEEKEND
    
    //Se oggi è sabato o domenica allora deve essere questo weekend
    $today_week=date('w');
    if($today_week==0){
        $suffisso_titolo = 'Questo Weekend';
        $saturday = date("Ymd", strtotime('-1 day'));
        $sunday = date("Ymd");
    } elseif($today_week==6){
        $suffisso_titolo = 'Questo Weekend';
        $saturday = date("Ymd");
        $sunday = date("Ymd", strtotime('+1 day'));
    } else {
        $suffisso_titolo = 'Prossimo Weekend';
        $saturday = date("Ymd", strtotime('next Saturday'));
        $sunday = date("Ymd", strtotime('next Sunday'));
    }

    $args = array_merge( $wp_query->query_vars, array(
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'data_da',
                'value'   => $sunday,
                'type'    => 'DATE',
                'compare' => '<=',
            ),
            array(
                'key' => 'data_a',
                'value'   => $saturday,
                'type'    => 'DATE',
                'compare' => '>=',
            ),
        ),
        'meta_key'   => 'voto',
        'orderby'    => 'meta_value_num',
        'order'      => 'DESC',
    ) );
    query_posts( $args );
    
} elseif(isset($_GET['ss']) && $_GET['ss']=='recensioni'){
    ////////////////////////////////////////////////////////////////////////
    //RICERCA SPETTACOLO PER RECENSIONI
    
    $args = array_merge( $wp_query->query_vars, array(
        'content_filter' => 'NOT_EMPTY',
        'meta_key'   => 'voto',
        'orderby'    => 'meta_value_num',
        'order'      => 'DESC',
    ) );
    query_posts( $args );
} elseif(isset($_GET['ss']) && $_GET['ss']=='month'){
    ////////////////////////////////////////////////////////////////////////
    //RICERCA SPETTACOLO PER DATA: MESE
    
    $firt_day = ((int) $_GET['l']);
    $suffisso_titolo = __(date("F", strtotime($firt_day))).' '.date("Y", strtotime($firt_day));
    $last_day = date("Ymt", strtotime($firt_day));

    $args = array_merge( $wp_query->query_vars, array(
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'data_da',
                'value'   => $last_day,
                'type'    => 'DATE',
                'compare' => '<=',
            ),
            array(
                'key' => 'data_a',
                'value'   => $firt_day,
                'type'    => 'DATE',
                'compare' => '>=',
            ),
        ),
        'meta_key'   => 'voto',
        'orderby'    => 'meta_value_num',
        'order'      => 'DESC',
    ) );
    query_posts( $args );
    
    //print_variable($GLOBALS['wp_query']->request);
    
} else {
    $args = array_merge( $wp_query->query_vars, array(
        'meta_key'   => 'voto',
        'orderby'    => 'meta_value_num',
        'order'      => 'DESC',
    ) );

    query_posts( $args );
}



$back_to='/cerca-spettacolo';
if(isset($_GET['cal']) && $_GET['cal']==1){
    $back_to='/calendari';
}
?>
<div class="back-to">
    <a href="<?php echo $back_to;?>">
        torna alla ricerca
    </a>
</div>
	<div id="primary" class="site-content">
            <div id="content" role="main">
<?php if(isset($_GET['ss']) && $_GET['ss']=='recensioni'): ?>
<div class="claim">
Prima si vede, poi si scrive. Questa sezione, infatti, è in continuo aggiornamento perché 
    <a href="#" class="leggi-tutto">... [leggi tutto]</a>
    <span class="leggi-tutto-testo">
        le recensioni vengono pubblicate solo dopo 
        che gli spettacoli sono stati visti dai nostri critici. Hystrio si 
        riserva inoltre la scelta di quali titoli recensire. Al momento sono 
        esclusi gli spettacoli di danza (e dintorni) e, salvo eccezioni, tutti 
        quegli eventi che hanno in cartellone una permanenza inferiore alle 3 repliche.
    </span>
</div>
<?php endif;  ?>                    

                <?php if(isset($_GET['ss']) && $_GET['ss']=='recensioni'): ?>
                <h1 class="archive-title">SPETTACOLI RECENSITI</h1>
                <?php elseif(isset( $_GET['ss'] )): ?>
                    <h1 class="archive-title">CERCA SPETTACOLO<?php if($suffisso_titolo){ echo ': <span class="suffisso_titolo">'.$suffisso_titolo.'</span>'; }?></h1>
                <?php else : ?>
                    <h1 class="archive-title">SPETTACOLI</h1>
                <?php endif;  ?>                    

<?php
$aSearch=array();
if(isset($_GET['ss']) && $_GET['ss']=='csp'){
    if($_GET['f-titolo']) $aSearch[]='<span class="sub.tit">Titolo</span> '.$_GET['f-titolo'];
    if($_GET['f-autore']) $aSearch[]='<span class="sub.tit">Autore</span> '.$_GET['f-autore'];
    if($_GET['f-regia'])  $aSearch[]='<span class="sub.tit">Regia</span> '.$_GET['f-regia'];
    if($_GET['f-cast'])   $aSearch[]='<span class="sub.tit">Cast</span> '.$_GET['f-cast'];

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
        
        if($spettacolo_orari) $teatro_orari=$spettacolo_orari;
        if($spettacolo_prezzi)$teatro_prezzi=$spettacolo_prezzi;
        
        get_template_part( 'spettacolo','list' );
?>
<?php endwhile; ?>
</div>

		<?php else : ?>

                    <article id="post-0" class="post no-results not-found">
                        <header class="entry-header">
                            <h2 class="entry-title no-results">Nessuno spettacolo trovato!</h2>
                        </header>
                        <div class="entry-content">
                            <p><a href="/cerca-spettacolo" title="Effettua una nuova ricerca Ricerca">Clicca qui per fare una nuova ricerca</a></p>
                        </div><!-- .entry-content -->
                    </article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>