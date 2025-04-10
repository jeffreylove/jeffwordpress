<?php get_header(); ?>

<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

<?php the_title(); ?>
<?php the_content(); ?>
<h1>-front-page.php</h1>
<?php endwhile; endif; ?>

<?php get_template_part('content', 'portfolio'); ?>

<?php get_footer(); ?>