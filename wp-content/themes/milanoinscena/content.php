<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if ( is_single() ) : ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single() ?>
    </header><!-- .entry-header -->

    <?php if ( is_single() ) : // Only display Excerpts for Search ?>
    <div class="entry-content">
        <?php the_content(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

    <footer class="entry-meta">
        <?php twentytwelve_entry_meta(); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post -->
