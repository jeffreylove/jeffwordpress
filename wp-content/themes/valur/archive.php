<?php get_header(); ?>

<h1><?php wp_title(''); ?> Blog Posts</h1>
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<h1>archive.php</h1>
<?php the_excerpt(); ?>
<?php echo get_avatar(get_the_author_meta('ID'), 24); ?>
by <?php the_author_posts_link(); ?>
<?php the_category(', '); ?>
<?php the_time('F j Y'); ?>

<?php if(get_the_post_thumbnail()) : ?>
<?php the_post_thumbnail('large'); ?>
<?php endif; ?>

<?php endwhile; else : ?>
	<p><?php _e('Sorry. No pages found.'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>