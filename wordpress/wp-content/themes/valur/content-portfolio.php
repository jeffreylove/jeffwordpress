<?php

$num_posts = (is_front_page()) ? 4 : -1;

$args = array(
	'post_type' => 'portfolio',
	'posts_per_page' => $num_posts
);
$query = new WP_Query($args);
?>
<section>
<?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
<h1>content-portfolio.php</h1>
<?php endwhile; endif; wp_reset_postdata(); ?>
</section>