<?php get_header(); ?>
<style>
    /* Hide the blog slider section on single post pages */
    .blogSliderSection {
        display: none !important;
    }
</style>

<div class="post-details blogContent">
	<div class="breadCrumb">
		<?php echo do_shortcode("[valur_breadcrumb]"); ?>
	</div>
	<div class="row blogContentRow">
		<div class="col-md-5">
			<div class="imageBox">
				<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
				<?php if(get_the_post_thumbnail()) : ?>
				<?php the_post_thumbnail('large'); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-7">
			<div class="contentBox">
				<h3><?php the_category(', '); ?></h3>
				<h1><?php the_title(); ?></h1>
				<div class="mergeBox">
					<div class="authorBox">
						<span><?php the_author_posts_link(); ?></span>
					</div>
					<div class="dateBox">
						<span>Last updated: <?php the_time('d.m.y'); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row mainRow">

		<div class="col-md-3">
			<?php echo do_shortcode('[ez-toc]'); ?>
			<div class="blogs-author">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta('ID'), 96 ); // 96 is the size of the avatar ?>
				</div>
				<div class="authordetails">
					<h4><?php the_author(); ?></h4>
					<?php 
					$custom_value = get_post_meta(get_the_ID(), 'author_designation', true);
					if ($custom_value) {
						echo '<p> ' . esc_html($custom_value) . '</p>';
					}
					?>
				</div>
			</div>
			<div class="authordiscription">
				<?php 
				$custom_value = get_post_meta(get_the_ID(), 'author_discription', true);
				if ($custom_value) {
					echo '<p>' . esc_html($custom_value) . '</p>';
				}
				?>
			</div>
			
		</div>

		<div class="col-md-9">
			<?php the_content(); ?>
		</div>
	</div>
	<section class="contactSection">
		<div class="row">
			<div class="col-md-4">
				</div>	
			<div style="text-align:center !important;" class="col-md-4">
                 <a class="designBtn" href="#">TALK TO OUR TEAM<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			</div>
			<div class="col-md-4">
				<?php //  echo do_shortcode("[contact-form-7 id='901e458' title='subscription']"); ?>	
			</div>
		</div>


	</section>
	
<section class="related-post">
		 
	<div class="row">
		<div class="col-md-12">
		<h2>Related Articles</h2>
			<?php echo do_shortcode('[related__grid_shortcode]'); ?> 
		</div>
	</div>
</section>
<?php endwhile; else : ?>
	<p><?php _e('Sorry. No content found.'); ?></p>
<?php endif; ?>
</div>
<?php get_footer(); ?>