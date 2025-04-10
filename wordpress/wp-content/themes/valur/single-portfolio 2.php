<?php get_header(); ?>

<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
<?php the_title(); ?>
<?php the_content(); ?>
<?php the_field('images'); ?>

<?php previous_post_link(); ?> - 
<a href="<?php bloginfo('url'); ?>/portfolio">Back to Portfolio</a> - 
<?php next_post_link(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>