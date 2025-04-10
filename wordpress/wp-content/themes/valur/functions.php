<?php
if(function_exists('add_theme_support')){
	add_theme_support('post-thumbnails');	/* Featured images. */
	add_theme_support('menus');				/* Menus. */
}

/* Excerpt. */
function wpt_excerpt_length($length){
	return 50;
}
add_filter('excerpt_length', 'wpt_excerpt_length', 999);

/* Menus. - Register Custom Navigation Walker.
https://github.com/wp-bootstrap/wp-bootstrap-navwalker
*/
require_once get_template_directory().'/wp-bootstrap-navwalker.php';
/*require_once( ABSPATH . WPINC . '/wp-user.php' );*/
register_nav_menus(array(
    'primary' => __( 'Primary Menu'),
));
/* END - Menus. - Register Custom Navigation Walker. */

/* Widgets */
function create_widget($name, $id, $description){
	$before_title = '';
	$after_title = '';
	
	// Special styling for Recent Posts widget
	if ($id === 'recent-posts') {
		$before_title = '<h2 class="widget-title">';
		$after_title = '</h2>';
	}
	
	register_sidebar(array(
		'name' => __($name),
		'id' => $id,
		'description' => __($description),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => $before_title,
		'after_title' => $after_title
	));
}
create_widget('Page Sidebar','page','Appears in side of pages with a sidebar.');
create_widget('Blog Sidebar','blog','Appears in side of pages with a sidebar.');
create_widget('Header Logo','h-logo','Appears in header.');
create_widget('Header Buttons','h-btn','Appears in header.');
create_widget('Header Area 3','header3','Appears in header.');
create_widget('Header Area 4','header4','Appears in header.');
create_widget('Footer Logo','f-logo','Appears in footer.');
create_widget('Footer Cases Links','f-cases','Appears in footer.');
create_widget('Footer Solution Links','f-solution','Appears in footer.');
create_widget('Footer Terms Links','f-terms','Appears in footer.');
create_widget('Footer Contact Button','f-contact','Appears in footer.');
create_widget('Recent Posts','recent-posts','Appears in Blog Sidebar.');
/* END - Widgets */

/* CSS */
function awgms_theme_styles(){
	//wp_enqueue_style('font_awesome_css', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('bootstrap_icon', get_template_directory_uri() . '/fonts/bootstrap-icons.css');
    wp_enqueue_style('inter_css', 'https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap');
    wp_enqueue_style('font_css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
    wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('swiper-bundle_css', get_template_directory_uri() . '/css/swiper-bundle.min.css');
    wp_enqueue_style('style_css', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'awgms_theme_styles');

/* JS */
function awgms_theme_js(){
	wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true);
	wp_enqueue_script('swiper-bundle_js', get_template_directory_uri() . '/js/swiper-bundle.min.js');
	wp_enqueue_script('custom_js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'awgms_theme_js');

// Home PAge Front Blog Slider 

function blog_slider($atts) { 
	ob_start(); 
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => -1,
		'category_name'  => 'Featured Article',
		'order'  => 'ASC',
	);

	$query = new WP_Query($args);
?>
		<div class="blogSwiper-container">
		<div class="swiper-wrapper">
			 <?php if ($query-> have_posts() ) : while( $query-> have_posts()  ) : $query-> the_post(); ?>
			<div class="swiper-slide">
				<div class="row">
					<div class="col-md-5">
					
						<?php if(get_the_post_thumbnail()) : ?>
							<?php the_post_thumbnail('large'); ?>
						<?php endif; ?>
					</div>
					<div class="col-md-7">
							
						<div class="contentBox">
							<h3><?php the_category(', '); ?></h3>
							<h1><?php the_title(); ?></h1>
							<?php the_excerpt();?>
							<div class="mergeBox">
								<div class="authorBox">
									 <span><?php the_author_posts_link(); ?></span>
								</div>
								<div class="dateBox">
									 <span>Last updated: <?php the_time('d.m.y'); ?></span>
								</div>
							</div>
							<a class="readMore" href="<?php the_permalink() ?>">Read More</a>
						</div>
						
					
					</div>
				</div>
			</div>
			 <?php

          endwhile; 
      endif; wp_reset_postdata();    
      ?>    
		</div>
		<!-- If we need pagination -->
   		 <div class="swiper-pagination"></div>
		
		<!-- If we need navigation buttons -->
<!-- 		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div> -->
	</div>
<?php $myvariable = ob_get_clean();
	return $myvariable; }
add_shortcode( 'blog_slider_shortcode', 'blog_slider');




// for single related post
function related__grid($atts) {
	ob_start();
	// Get the current page number
// 	$paged = (isset($_GET['paged'])) ? $_GET['paged'] : 1;
	
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,  // Display 12 posts per page
		'order'          => 'ASC',
// 		'paged'          => $paged,  // Handle pagination
	);

	$query = new WP_Query($args);
	?>

	<div class="row">
		<?php if ($query->have_posts()) : ?>
			<?php while ($query->have_posts()) : $query->the_post(); ?>
			
				<div class="col-md-4 single-blog">
					<div class="mainbox">		
							<a href="<?php the_permalink(); ?>" class="post-link">				
								<div class="imageBox">
									<?php if (get_the_post_thumbnail()) : ?>
										<?php the_post_thumbnail('large'); ?>
									<?php endif; ?>
								</div>
							</a>						
							<div class="contentBox">
								<div class="mergeBox">
									<div class="authorBox">
										<span><?php the_author_posts_link(); ?></span>
									</div>
									<div class="dateBox">
										<span>Last updated: <?php the_time('d.m.y'); ?></span>
									</div>
								</div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
							</div>
						</div>
					
				</div>
				
			<?php endwhile; ?>
		</div>

		<!-- Pagination -->
<!-- 			<div class="paginationBox">
				<div class="pagination">
 					<?php 
				echo paginate_links(array(
					'total'        => $query->max_num_pages,
					'current'      => $paged,
 					'format'       => '?paged=%#%',   // Proper pagination format
					'prev_text'    => __('« Previous'),
					'next_text'    => __('Next »'),
				)); 
					?>
				</div>
			</div> -->
		<?php else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

	<?php wp_reset_query(); ?>

	<?php $myvariable = ob_get_clean();
		return $myvariable;
}

// Register the shortcode
add_shortcode('related__grid_shortcode', 'related__grid');

// Home Page Blog Grid Starts

// Main function for the shortcode
function home_blog_grid($atts) {
	ob_start();
	// Get the current page number
	$paged = (isset($_GET['paged'])) ? $_GET['paged'] : 1;
	
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 12,  // Display 12 posts per page
		'order'          => 'ASC',
		'paged'          => $paged,  // Handle pagination
	);

	$query = new WP_Query($args);
	?>

	<div class="row">
		<?php if ($query->have_posts()) : ?>
			<?php while ($query->have_posts()) : $query->the_post(); ?>
			
				<div class="col-md-4 single-blog">
					<div class="mainbox">		
							<a href="<?php the_permalink(); ?>" class="post-link">				
								<div class="imageBox">
									<?php if (get_the_post_thumbnail()) : ?>
										<?php the_post_thumbnail('large'); ?>
									<?php endif; ?>
								</div>
							</a>						
							<div class="contentBox">
								<div class="mergeBox">
									<div class="authorBox">
										<span><?php the_author_posts_link(); ?></span>
									</div>
									<div class="dateBox">
										<span>Last updated: <?php the_time('d.m.y'); ?></span>
									</div>
								</div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<a class="readMore" href="<?php the_permalink(); ?>">Read More</a>
							</div>
						</div>
					
				</div>
				
			<?php endwhile; ?>
		</div>

		<!-- Pagination -->
			<div class="paginationBox">
				<div class="pagination">
					<?php 
				echo paginate_links(array(
					'total'        => $query->max_num_pages,
					'current'      => $paged,
 					'format'       => '?paged=%#%',   // Proper pagination format
					'prev_text'    => __('« Previous'),
					'next_text'    => __('Next »'),
				));
					?>
				</div>
			</div>
		<?php else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

	<?php wp_reset_query(); ?>

	<?php $myvariable = ob_get_clean();
		return $myvariable;
}

// Register the shortcode
add_shortcode('home_blog_grid_shortcode', 'home_blog_grid');

// Fix for pagination on static home page
function custom_home_paged_query($query) {
	if (!is_admin() && $query->is_main_query() && is_front_page()) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$query->set('paged', $paged); // Set pagination
	}
}
add_action('pre_get_posts', 'custom_home_paged_query');

// Blog Sidebar Function
function blog_sidebar($atts) { 
	ob_start(); 
?>   
	<div class="blogSidebar">
		<div class="subscribeBox">
			<h3>Subscribe here!</h3>
			<p class="desc">Keep up to date with the latest insights on tax planning for your equity, small business, crypto, real estate, and more.</p>
			<?php echo do_shortcode('[contact-form-7 id="b58a7af" title="Sidebar Newsletter"]'); ?>
		</div>
		<div class="featuredPosts">
			<?php dynamic_sidebar('recent-posts'); ?>	
		</div>
	</div>		
<?php $myvariable = ob_get_clean();
	return $myvariable; }
add_shortcode( 'blog_sidebar_shortcode', 'blog_sidebar');



// Estate Tax Page Blog Grid Starts

// Main function for the shortcode
function estate_tax_blog_grid() {

	// Get the current page number
	$paged = (isset($_GET['paged'])) ? $_GET['paged'] : 1;
	
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 9,  // Display 12 posts per page
		'order'          => 'ASC',
		'paged'          => $paged,  // Handle pagination
	);

	$query = new WP_Query($args);
	?>

	<div class="row">
		<?php if ($query->have_posts()) : ?>
			<?php while ($query->have_posts()) : $query->the_post(); ?>
				<div class="col-md-4">
					<a href="<?php the_permalink(); ?>">
						<div class="imageBox">
							<?php if (get_the_post_thumbnail()) : ?>
								<?php the_post_thumbnail('large'); ?>
							<?php endif; ?>
						</div>
						<div class="contentBox">				
							<div class="mergeBox">
								<div class="authorBox">
									<span><?php the_author_posts_link(); ?></span>
								</div>
								<div class="dateBox">
									<span>Last updated: <?php the_time('d.m.y'); ?></span>
								</div>
							</div>
							<h2><?php the_title(); ?></h2>
							<a class="readMore" href="<?php the_permalink(); ?>">Read More -></a>
						</div>
					</a>
				</div>
			<?php endwhile; ?>
		</div>

		<!-- Pagination -->
			<div class="paginationBox">
				<div class="pagination">
					<?php 
				echo paginate_links(array(
					'total'        => $query->max_num_pages,
					'current'      => $paged,
 					'format'       => '?paged=%#%',   // Proper pagination format
					'prev_text'    => __('« Previous'),
					'next_text'    => __('Next »'),
				));
					?>
				</div>
			</div>
		<?php else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

	<?php wp_reset_query(); ?>

	<?php
}

// Register the shortcode
add_shortcode('estate_tax_blog_grid_shortcode', 'estate_tax_blog_grid');


// Post subscribe submit function
function post_subscribe($atts) { 
    ob_start(); 
    
    ?>
    <section class="contactSection">
        <div class="row">
            <div class="col-md-3">
            </div>  
            <div class="col-md-7">
                <?php echo do_shortcode("[contact-form-7 id='901e458' title='subscription']"); ?>    
            </div>
<!--             <div class="col-md-4">
                <a class="designBtn" href="#">TALK TO OUR TEAM<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            </div> -->
        </div>
    </section>
    <?php
    
    $output = ob_get_clean(); // End buffering and get the content
    return $output; // Return the content for the shortcode
}
add_shortcode('post_subscribe_shortcode', 'post_subscribe');



// Fix for pagination on static home page
function estate_tax_paged_query($query) {
	if (!is_admin() && $query->is_main_query() && is_front_page()) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$query->set('paged', $paged); // Set pagination
	}
}
add_action('pre_get_posts', 'estate_tax_paged_query');

?>