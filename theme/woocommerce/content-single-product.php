<?php

defined('ABSPATH') || exit;

global $product;

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" class="container mx-auto">

    <div class="flex flex-row">

        <div>
        	<div class="w-3/5">
            <?php
            echo wp_get_attachment_image($product->get_image_id(), 'full');
            ?>
	        </div>

	        <div class="w-32 flex flex-row">
	            <?php
	            $attachment_ids = $product->get_gallery_image_ids();
	            if ($attachment_ids) {
	                foreach ($attachment_ids as $attachment_id) {
	                    echo wp_get_attachment_image($attachment_id, 'full');
	                }
	            }
	            ?>
	        </div>
	    </div>

	    <div class="custom-product-details">
	        <h1 class="custom-product-title"><?php echo esc_html($product->get_name()); ?></h1>
	        <div class="custom-product-price"><?php echo $product->get_price_html(); ?></div>
	        <div class="custom-product-description"><?php echo $product->get_description(); ?></div>

	        <form class="custom-add-to-cart" method="post" enctype="multipart/form-data">
	            
	            <div class="custom-add-to-cart-button">
	                <?php woocommerce_template_single_add_to_cart(); ?>
	            </div>
	            
	        </form>
	    </div>
	</div>
</div>
