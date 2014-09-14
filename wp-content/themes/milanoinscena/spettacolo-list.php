<?php
$id_teatro=get_field('teatro');

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
?>
<div class="spettacolo-i">
    <div class="spettacolo-cont">
        <div class="col-1">
            <div class="col-a">
                <h3 class="title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"  title="<?php echo esc_attr( 'Scheda Spettacolo: '.the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="teatro">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"  title="<?php echo esc_attr( 'Scheda Spettacolo: '.the_title_attribute( 'echo=0' ) ); ?>"><?php echo get_the_title($id_teatro); ?></a>
                </div>
            </div>
            <div class="col-b">
                <div class="data"><span>dal:</span> <?php echo $data_da;?> <span>al:</span> <?php echo $data_a;?></div>
                <div class="in-corso-i in-corso-<?php echo $s_status_slug;?>">
                    <?php echo $s_status_text;?>
                </div>
            </div>
        </div>
        <div class="col-2">
            <a href="<?php the_permalink(); ?>" class="voto-i voto-<?php echo str_replace('.', '_', $voto);?>"  title="<?php echo esc_attr( 'Scheda Spettacolo: '.the_title_attribute( 'echo=0' ) ); ?>">Voto <?php echo $voto;?></a>
        </div>
        <div class="col-3">
            <a href="<?php the_permalink(); ?>" rel="bookmark"  title="<?php echo esc_attr( 'Scheda Spettacolo: '.the_title_attribute( 'echo=0' ) ); ?>" class="link-spettacolo">Scheda Spettacolo</a>
        </div>
    </div>
    <div class="data-voto-smartphone">
        <div class="data"><span>dal:</span> <?php echo $data_da;?> <span>al:</span> <?php echo $data_a;?></div>
        <div class="in-corso-i in-corso-<?php echo $s_status_slug;?>">
            <?php echo $s_status_text;?>
        </div>
    </div>
</div>
