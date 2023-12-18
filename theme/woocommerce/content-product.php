<?php
defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
   return;
}
?>
<li class="group text-base-content">
    <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
        <?php
        $image_url = wp_get_attachment_image_url( $product->get_image_id(), 'full' );
        ?>
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg xl:aspect-h-8 xl:aspect-w-7">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" />
        </div>
        
        <h3 class="mt-4 text-sm"><?php echo $product->get_name(); ?></h2>
    </a>
    <p class="mt-1 text-lg font-medium">
        <?php echo $product->get_price_html(); ?>
    </p>
</li>
