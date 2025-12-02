<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        <div class="entry-meta"><?php echo get_the_date(); ?></div>
    </header>
    <div class="entry-content">
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>">Lees meer</a>
    </div>
</article>
