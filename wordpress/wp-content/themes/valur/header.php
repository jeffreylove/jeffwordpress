<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="HTML,CSS">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
		<link rel="icon" type="image/png" href="<?php echo get_site_url(); ?>"/>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<div class="container">
				<div class="row firstRow">
					<div class="col-md-2 logocol">
						<div class="hLogo">
							<?php dynamic_sidebar('h-logo'); ?>			
						</div>
					</div>
					<div class="col-md-6">
						<div class="navigation">
							<?php include("navigation.php"); ?>	
						</div>
					</div>
					<div class="col-md-3 btnCol">
						<div class="hBtn">
							<?php dynamic_sidebar('h-btn'); ?>			
						</div>
					</div>
				</div><!--row-->
			</div><!--container-->
		<div class="secondRowWrapper">
			<div class="container">
				<div class="row secondRow">
					<div class="col-md-9">
						<div class="navigation navigation-dropdown">
							<?php wp_nav_menu( array( 'theme_location' => 'max_mega_menu_1' ) ); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="hSearch">
							<i class="bi bi-search"></i>
							<input type="search" placeholder="Search" name="search"/>		
						</div>
					</div>
				</div>
			</div><!--container-->
			<a href="#">
				<div class="getStartedButton">
					<img src="../../../wp-content/uploads/2024/09/Group-106.svg"/>
				</div></a>

<!-- Estate Tax Started -->
			<div class="fullscreenmenu estatetax">
				<div class="container">
					<div class="row">
							<div class="col-md-4">
								<div class="solution">
									<h3>SOLUTIONS</h3>
									<?php
									// Define the category name or slug
									$category_name = 'Featured Article';

									// Create a custom query to get posts from the 'Featured Article' category
									$featured_query = new WP_Query( array(
										'category_name' => $category_name, // Category name or slug
										'posts_per_page' => 100 // Limit to the number of posts you want to display
									) );

									// Check if the query has posts
									if ( $featured_query->have_posts() ) : 
									echo '<div class="featured-articles">';
// 									echo '<h2>' . esc_html( $category_name ) . '</h2>'; // Header with the category name

									while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

									<div class="featured-article">
										<div class="article-content">
											<div class="article-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/Group <?php echo rand(14, 43); ?>.png" alt="Icon">
											</div>
											<div class="article-text">
												<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
												<p><?php the_excerpt(); ?></p> <!-- Display the excerpt -->
											</div>
										</div>
									</div>

									<?php endwhile;

									echo '</div>';

									// Restore original post data
									wp_reset_postdata();

									else :
									echo '<p>No posts found in this category.</p>'; // If no posts found in the category
									endif;
									?>

								</div>
							</div>
							<div class="col-md-4">
								<div class="readup">
									<h3>READ UP</h3>
									<div class="cardwrapper">
										<div class="cardone">
											<a href="#">
												<div class="card-content">
													<div class="card-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/Group 30.png" alt="Icon">
													</div>
													<div class="card-text">
														<h4>All estate tax articles</h4>
														<p>Start from the ground up. Review our primers, guides to specific structures, and detailed case studies</p>
													</div>
												</div>
											</a>
										</div>
										<div class="cardone">
											<a href="#">
												<div class="card-content">
													<div class="card-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/Group 31.png" alt="Icon">
													</div>
													<div class="card-text">
														<h4>Estate tax video</h4>
														<p>Check out our video series on planning to reduce your estate tax</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="blog">
									<?php
									// Query for the latest post
									$latest_post_query = new WP_Query(array(
										'posts_per_page' => 1, // Get only one post
									));

									if ($latest_post_query->have_posts()) {
										while ($latest_post_query->have_posts()) {
											$latest_post_query->the_post();
									?>


									<?php if (has_post_thumbnail()) : ?>
									<div class="post-thumbnail">
										<?php the_post_thumbnail('large'); // You can specify other sizes like 'medium', 'thumbnail', etc. ?>
									</div>
									<?php endif; ?>
									<h1><?php the_title(); ?></h1>
									<div><?php the_content(); ?></div>
									<a href="<?php echo get_permalink(); ?>" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
									<?php
										}
									} else {
										echo '<p>No posts found.</p>';
									}

									// Reset post data
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</div>
			<!-- Estate Tax Ended -->
			
			
			<!-- Capital Gains Started -->
			<div class="fullscreenmenu capitalgains">
				<div class="container">
					<div class="row">
						<div class="col-md-11">
							<div class="col-md-4">
								<div class="solution">
									<h3>SOLUTIONS</h3>
									<?php
									// Define the category name or slug
									$category_name = 'Featured Article';

									// Create a custom query to get posts from the 'Featured Article' category
									$featured_query = new WP_Query( array(
										'category_name' => $category_name, // Category name or slug
										'posts_per_page' => 100 // Limit to the number of posts you want to display
									) );

									// Check if the query has posts
									if ( $featured_query->have_posts() ) : 
									echo '<div class="featured-articles">';
// 									echo '<h2>' . esc_html( $category_name ) . '</h2>'; // Header with the category name

									while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

									<div class="featured-article">
										<div class="article-content">
											<div class="article-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/Group <?php echo rand(14, 43); ?>.png" alt="Icon">
											</div>
											<div class="article-text">
												<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
												<p><?php the_excerpt(); ?></p> <!-- Display the excerpt -->
											</div>
										</div>
									</div>

									<?php endwhile;

									echo '</div>';

									// Restore original post data
									wp_reset_postdata();

									else :
									echo '<p>No posts found in this category.</p>'; // If no posts found in the category
									endif;
									?>

								</div>
							</div>
							<div class="col-md-4">
								<div class="readup">
									<h3>READ UP</h3>
									<div class="cardwrapper">
										<div class="cardone">
											<a href="#">
												<div class="card-content">
													<div class="card-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/Group 32.png" alt="Icon">
													</div>
													<div class="card-text">
														<h4>All Capital Gains articles</h4>
														<p>Start from the ground up. Review our primers, guides to specific structures, and detailed case studies</p>
													</div>
												</div>
											</a>
										</div>
										<div class="cardone">
											<a href="#">
												<div class="card-content">
													<div class="card-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/Group 33.png" alt="Icon">
													</div>
													<div class="card-text">
														<h4>Capital Gains video</h4>
														<p>Check out our video series on planning to reduce your Capital Gains</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="blog">
									<?php
									// Query for the latest post
									$latest_post_query = new WP_Query(array(
										'posts_per_page' => 1, // Get only one post
									));

									if ($latest_post_query->have_posts()) {
										while ($latest_post_query->have_posts()) {
											$latest_post_query->the_post();
									?>


									<?php if (has_post_thumbnail()) : ?>
									<div class="post-thumbnail">
										<?php the_post_thumbnail('large'); // You can specify other sizes like 'medium', 'thumbnail', etc. ?>
									</div>
									<?php endif; ?>
									<h1><?php the_title(); ?></h1>
									<div><?php the_content(); ?></div>
									<a href="<?php echo get_permalink(); ?>" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
									<?php
										}
									} else {
										echo '<p>No posts found.</p>';
									}

									// Reset post data
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</div>
			<!-- Capital Gains Ended -->
			
			
			<!-- Ordinary income Started -->
			<div class="fullscreenmenu ordinary">
				<div class="container">
					<div class="row">
						<div class="col-md-11">
							<div class="col-md-4">
								<div class="solution">
									<h3>SOLUTIONS</h3>
									<?php
									// Define the category name or slug
									$category_name = 'Featured Article';

									// Create a custom query to get posts from the 'Featured Article' category
									$featured_query = new WP_Query( array(
										'category_name' => $category_name, // Category name or slug
										'posts_per_page' => 100 // Limit to the number of posts you want to display
									) );

									// Check if the query has posts
									if ( $featured_query->have_posts() ) : 
									echo '<div class="featured-articles">';
// 									echo '<h2>' . esc_html( $category_name ) . '</h2>'; // Header with the category name

									while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

									<div class="featured-article">
										<div class="article-content">
											<div class="article-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/Group <?php echo rand(14, 43); ?>.png" alt="Icon">
											</div>
											<div class="article-text">
												<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
												<p><?php the_excerpt(); ?></p> <!-- Display the excerpt -->
											</div>
										</div>
									</div>

									<?php endwhile;

									echo '</div>';

									// Restore original post data
									wp_reset_postdata();

									else :
									echo '<p>No posts found in this category.</p>'; // If no posts found in the category
									endif;
									?>

								</div>
							</div>
							<div class="col-md-4">
								<div class="readup">
									<h3>READ UP</h3>
									<div class="cardwrapper">
										<div class="cardone">
											<a href="#">
												<div class="card-content">
													<div class="card-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/Group 34.png" alt="Icon">
													</div>
													<div class="card-text">
														<h4>All Ordinary income articles</h4>
														<p>Start from the ground up. Review our primers, guides to specific structures, and detailed case studies</p>
													</div>
												</div>
											</a>
										</div>
										<div class="cardone">
											<a href="#">
												<div class="card-content">
													<div class="card-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/Group 35.png" alt="Icon">
													</div>
													<div class="card-text">
														<h4>Capital Ordinary video</h4>
														<p>Check out our video series on planning to reduce your Ordinary income</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="blog">
									<?php
									// Query for the latest post
									$latest_post_query = new WP_Query(array(
										'posts_per_page' => 1, // Get only one post
									));

									if ($latest_post_query->have_posts()) {
										while ($latest_post_query->have_posts()) {
											$latest_post_query->the_post();
									?>


									<?php if (has_post_thumbnail()) : ?>
									<div class="post-thumbnail">
										<?php the_post_thumbnail('large'); // You can specify other sizes like 'medium', 'thumbnail', etc. ?>
									</div>
									<?php endif; ?>
									<h1><?php the_title(); ?></h1>
									<div><?php the_content(); ?></div>
									<a href="<?php echo get_permalink(); ?>" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
									<?php
										}
									} else {
										echo '<p>No posts found.</p>';
									}

									// Reset post data
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</div>
			<!-- Ordinary income Ended -->
			
			<!-- qsbs  Started -->
			<div class="fullscreenmenu qsbs">
				<div class="container">
					<div class="row">
						<div class="col-md-11">
							<div class="col-md-4">
								<div class="solution">
									<h3>SOLUTIONS</h3>
									<?php
									// Define the category name or slug
									$category_name = 'Featured Article';

									// Create a custom query to get posts from the 'Featured Article' category
									$featured_query = new WP_Query( array(
										'category_name' => $category_name, // Category name or slug
										'posts_per_page' => 100 // Limit to the number of posts you want to display
									) );

									// Check if the query has posts
									if ( $featured_query->have_posts() ) : 
									echo '<div class="featured-articles">';
// 									echo '<h2>' . esc_html( $category_name ) . '</h2>'; // Header with the category name

									while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

									<div class="featured-article">
										<div class="article-content">
											<div class="article-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/Group <?php echo rand(14, 43); ?>.png" alt="Icon">
											</div>
											<div class="article-text">
												<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
												<p><?php the_excerpt(); ?></p> <!-- Display the excerpt -->
											</div>
										</div>
									</div>

									<?php endwhile;

									echo '</div>';

									// Restore original post data
									wp_reset_postdata();

									else :
									echo '<p>No posts found in this category.</p>'; // If no posts found in the category
									endif;
									?>

								</div>
							</div>
							<div class="col-md-4">
								<div class="readup">
									<h3>READ UP</h3>
									<div class="cardwrapper">
										<div class="cardone">
											<a href="#">
												<div class="card-content">
													<div class="card-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/Group 36.png" alt="Icon">
													</div>
													<div class="card-text">
														<h4>All QSBS articles</h4>
														<p>Start from the ground up. Review our primers, guides to specific structures, and detailed case studies</p>
													</div>
												</div>
											</a>
										</div>
										<div class="cardone">
											<a href="#">
												<div class="card-content">
													<div class="card-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/Group 37.png" alt="Icon">
													</div>
													<div class="card-text">
														<h4>QSBS video</h4>
														<p>Check out our video series on planning to reduce your QSBS</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="blog">
									<?php
									// Query for the latest post
									$latest_post_query = new WP_Query(array(
										'posts_per_page' => 1, // Get only one post
									));

									if ($latest_post_query->have_posts()) {
										while ($latest_post_query->have_posts()) {
											$latest_post_query->the_post();
									?>


									<?php if (has_post_thumbnail()) : ?>
									<div class="post-thumbnail">
										<?php the_post_thumbnail('large'); // You can specify other sizes like 'medium', 'thumbnail', etc. ?>
									</div>
									<?php endif; ?>
									<h1><?php the_title(); ?></h1>
									<div><?php the_content(); ?></div>
									<a href="<?php echo get_permalink(); ?>" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
									<?php
										}
									} else {
										echo '<p>No posts found.</p>';
									}

									// Reset post data
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</div>
			<!-- qsbs income Ended -->


		</header>

		<!-- Featured Articles Carousel Section -->
		<div class="blogSliderSection">
			<div class="container">
				<div class="featured-articles-grid">
					<?php
					// Define the category name or slug
					$category_name = 'Featured Article';

					// Create a custom query to get posts from the 'Featured Article' category
					$featured_query = new WP_Query( array(
						'category_name' => $category_name,
						'posts_per_page' => 3 // Limit to 3 posts for the featured layout
					) );

					// Check if the query has posts
					if ( $featured_query->have_posts() ) : 
						// Get the first post for the main featured article
						$featured_query->the_post();
						// Store the first post ID to exclude it from the small articles
						$main_post_id = get_the_ID();
					?>
					<div class="main-featured-article">
						<div class="article-flex-container">
							<?php if (has_post_thumbnail()) : ?>
							<div class="featured-image">
								<?php the_post_thumbnail('large'); ?>
							</div>
							<?php endif; ?>
							<div class="article-content">
								<h3 class="category-label">FEATURED ARTICLE</h3>
								<h2 style="font-size: 32px !important; line-height: 1.1; font-weight: 300; font-family: 'RecklessNeue', serif;"><a href="<?php the_permalink(); ?>" style="font-size: 32px !important; line-height: 1.1; font-weight: 300; font-family: 'RecklessNeue', serif;"><?php the_title(); ?></a></h2>
								<div class="excerpt"><?php the_excerpt(); ?></div>
								<a href="<?php the_permalink(); ?>" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>

					<div class="small-featured-articles">
						<?php 
						// Get the next two posts for the small featured articles
						while ( $featured_query->have_posts() ) : $featured_query->the_post(); 
						?>
						<div class="small-featured-article">
							<div class="article-flex-container">
								<?php if (has_post_thumbnail()) : ?>
								<div class="featured-image">
									<?php the_post_thumbnail('medium'); ?>
								</div>
								<?php endif; ?>
								<div class="article-content">
									<h3 class="category-label">FEATURED ARTICLE</h3>
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<a href="<?php the_permalink(); ?>" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php
					// Restore original post data
					wp_reset_postdata();
					else :
						echo '<p>No featured articles found.</p>';
					endif;
					?>
				</div>
			</div>
		</div>
		<!-- End Featured Articles Carousel Section -->

		<div class="container">
