<?php



get_header();
global $wp_query;
?>
<div class="wapper">
  <div class="contentarea clearfix search_page">
    <div class="content woocommerce">
      <h1 class="search-title"> <?php echo $wp_query->found_posts; ?>
        <?php _e( 'Search Results Found For', 'locale' ); ?>: "<?php the_search_query(); ?>" </h1>

        <?php if ( have_posts() ) { ?>

        	<ul class="products columns-4">
        		 <?php while ( have_posts() ) { the_post(); ?>
        		<li <?php wc_product_class( '', $product ); ?>>
        			<a href="<?php echo get_permalink(); ?>">
        				<?php  the_post_thumbnail('medium') ?>
        				<h2 class="woocommerce-loop-product__title"><?php echo $product->get_title();?></h2>
        				<span class="price">
        					<?php $product = new WC_Product(get_the_ID()); echo wc_price($product->get_price_including_tax(1,$product->get_price()));
										?>
        				</span>
        			</a>
                    <a href="<?php the_permalink(); ?>" class="button product_type_variable" rel="nofollow">Select options</a>
					
					
				</li>
				 <?php } ?>
        	</ul>

	   <div class="search-pagination"><?php echo paginate_links(); ?></div>

        <?php } ?>

    </div>
  </div>
</div>
<?php get_footer(); ?>