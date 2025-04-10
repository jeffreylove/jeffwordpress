<?php get_header(); ?>
<style>
    /* Hide the blog slider section on single post pages */
    .blogSliderSection {
        display: none !important;
    }
</style>

<div class="post-details blogContent">
	<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
	
	<div class="row">
		<div class="col-md-9">
			<!-- Featured image contained to article width -->
			<div class="article-width-image">
				<?php if(get_the_post_thumbnail()) : ?>
				<?php the_post_thumbnail('full'); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-3"><!-- Sidebar space --></div>
	</div>
	
	<div class="row">
		<div class="col-md-9">
			<div class="post-meta-container">
				<!-- Breadcrumbs below image -->
				<div class="breadCrumb">
					<?php echo do_shortcode("[valur_breadcrumb]"); ?>
				</div>
				
				<!-- Author and date info -->
				<div class="post-meta">
					<div class="mergeBox">
						<div class="authorBox">
							<span><?php the_author_posts_link(); ?></span>
						</div>
						<div class="dateBox">
							<span>Last updated: <?php the_time('d.m.y'); ?></span>
						</div>
					</div>
				</div>
				
				<!-- Title below meta info -->
				<h1 class="post-title"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="col-md-3"><!-- Sidebar space --></div>
	</div>
	
	<div class="row mainRow">

		<div class="col-md-9">
			<?php the_content(); ?>
			<div class="content-cta">
				<a class="designBtn" href="#">TALK TO OUR TEAM <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			</div>
		</div>

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