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
    'max_mega_menu_1' => __( 'Second Row Menu'),
));
/* END - Menus. - Register Custom Navigation Walker. */

// Add Advisors menu item to the max_mega_menu_1 menu
function add_advisors_menu_item() {
    // Get all nav menus
    $nav_menus = wp_get_nav_menus();
    
    if (!empty($nav_menus)) {
        // Look for the menu that's assigned to max_mega_menu_1 location
        $locations = get_nav_menu_locations();
        $menu_id = isset($locations['max_mega_menu_1']) ? $locations['max_mega_menu_1'] : null;
        
        // If we can't find it by location, try to find it by name or slug
        if (!$menu_id) {
            foreach ($nav_menus as $menu) {
                // Check if this might be our menu based on name
                if (strpos(strtolower($menu->name), 'max') !== false || 
                    strpos(strtolower($menu->name), 'mega') !== false || 
                    strpos(strtolower($menu->name), 'second') !== false || 
                    strpos(strtolower($menu->name), 'category') !== false) {
                    $menu_id = $menu->term_id;
                    break;
                }
            }
        }
        
        // If we still don't have a menu_id, just use the first menu
        if (!$menu_id && !empty($nav_menus)) {
            $menu_id = $nav_menus[0]->term_id;
        }
        
        if ($menu_id) {
            $advisors_url = home_url('/advisors');
            
            // Check if the Advisors menu item already exists
            $existing_items = wp_get_nav_menu_items($menu_id);
            $advisors_exists = false;
            
            if ($existing_items) {
                foreach ($existing_items as $item) {
                    if ($item->title == 'Advisors' || strpos($item->url, 'advisors') !== false) {
                        $advisors_exists = true;
                        break;
                    }
                }
            }
            
            // Add the Advisors menu item if it doesn't exist
            if (!$advisors_exists) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => 'Advisors',
                    'menu-item-url' => $advisors_url,
                    'menu-item-status' => 'publish',
                    'menu-item-type' => 'custom',
                    'menu-item-position' => 5
                ));
                
                // Log that we added the item
                error_log('Added Advisors menu item to menu ID: ' . $menu_id);
            }
        }
    }
}

// Run the function on theme setup
add_action('after_setup_theme', 'add_advisors_menu_item');

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
								<!-- Last updated text removed temporarily
							<div class="dateBox">
									 <span>Last updated: <?php the_time('d.m.y'); ?></span>
								</div>
							-->
							</div>
							<!-- Read more link removed temporarily
							<a class="readMore" href="<?php the_permalink() ?>">Read More</a>
							-->
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
	
	// Get the current post ID
	$current_post_id = get_the_ID();
	
	// Get the categories of the current post
	$categories = get_the_category($current_post_id);
	$category_ids = array();
	
	if (!empty($categories)) {
		foreach ($categories as $category) {
			$category_ids[] = $category->term_id;
		}
	}
	
	// Set up the query arguments
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post__not_in'   => array($current_post_id), // Exclude current post
		'category__in'   => $category_ids, // Posts in the same categories
		'orderby'        => 'date', // Order by date
		'order'          => 'DESC', // Most recent first
	);
	
	// If no categories, fall back to recent posts
	if (empty($category_ids)) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'post__not_in'   => array($current_post_id),
			'orderby'        => 'date',
			'order'          => 'DESC',
		);
	}

	$query = new WP_Query($args);
	?>

	<div class="row">
		<?php if ($query->have_posts()) : ?>
			<?php while ($query->have_posts()) : $query->the_post(); ?>
			
				<div class="col-md-4 single-blog">
					<a href="<?php the_permalink(); ?>" class="post-link" style="text-decoration: none;">
						<div class="mainbox">		
							<div class="imageBox">
								<?php if (get_the_post_thumbnail()) : ?>
									<?php the_post_thumbnail('large'); ?>
								<?php endif; ?>
							</div>
							<div class="contentBox">
								<h2><?php the_title(); ?></h2>
								<div class="mergeBox">
									<div class="author-avatar-small">
										<?php echo get_avatar( get_the_author_meta('ID'), 24 ); // 24px avatar size ?>
									</div>
									<div class="authorBox">
										<span><?php the_author_posts_link(); ?></span>
									</div>
									<!-- Last updated text removed for consistency
									<div class="dateBox">
										<span>Last updated: <?php the_time('d.m.y'); ?></span>
									</div>
									-->
								</div>
							</div>
						</div>
					</a>
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
					<a href="<?php the_permalink(); ?>" class="card-link" style="display:block; text-decoration:none; color:inherit;">
					<div class="mainbox">		
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
								<!-- Read more link removed temporarily
								<a class="readMore" href="<?php the_permalink(); ?>">Read More</a>
								-->
							</div>
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
								<!-- Last updated text removed temporarily
								<div class="dateBox">
									<span>Last updated: <?php the_time('d.m.y'); ?></span>
								</div>
								-->
							</div>
							<h2><?php the_title(); ?></h2>
							<!-- Read more link removed temporarily
							<a class="readMore" href="<?php the_permalink(); ?>">Read More -></a>
							-->
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

// Custom Breadcrumb Function for Single Posts
function valur_custom_breadcrumb() {
    if (!is_single()) return '';
    
    // Inline styles to ensure proper display
    $inline_styles = 'style="display: flex; align-items: center; flex-wrap: wrap; gap: 5px; font-size: 14px; font-weight: 500; color: #80848B; margin-bottom: 20px; background: transparent; padding: 0; border: none;"';
    $link_styles = 'style="color: #80848B; text-decoration: none; font-size: 14px; font-weight: 500; background: transparent; padding: 0; margin: 0; border: none;"';
    $current_styles = 'style="color: #635BFF; font-weight: 600; font-size: 14px; text-decoration: none; background: transparent; padding: 0; margin: 0;"';
    $separator_styles = 'style="color: #80848B; margin: 0 2px; font-size: 14px;"';
    
    $output = '<div class="valur-breadcrumb" ' . $inline_styles . '>';
    
    // Home/Library link
    $output .= '<a href="' . home_url() . '" ' . $link_styles . '>Valur Library</a>';
    
    // Category
    $categories = get_the_category();
    if (!empty($categories)) {
        $category = $categories[0]; // Get the first category
        $output .= ' <span class="breadcrumb-separator" ' . $separator_styles . '>&gt;</span> ';
        $output .= '<a href="' . get_category_link($category->term_id) . '" ' . $link_styles . '>' . $category->name . '</a>';
    }
    
    // First tag if present
    $tags = get_the_tags();
    if (!empty($tags)) {
        $tag = $tags[0]; // Get the first tag
        $output .= ' <span class="breadcrumb-separator" ' . $separator_styles . '>&gt;</span> ';
        $output .= '<a href="' . get_tag_link($tag->term_id) . '" ' . $link_styles . '>' . $tag->name . '</a>';
    }
    
    // Current post title
    $output .= ' <span class="breadcrumb-separator" ' . $separator_styles . '>&gt;</span> ';
    $output .= '<span class="current-page" ' . $current_styles . '>' . get_the_title() . '</span>';
    
    $output .= '</div>';
    
    return $output;
}

// Shortcode for the custom breadcrumb
function valur_breadcrumb_shortcode() {
    return valur_custom_breadcrumb();
}
add_shortcode('valur_breadcrumb', 'valur_breadcrumb_shortcode');

?>