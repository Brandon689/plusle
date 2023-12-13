<?php
defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
   return;
}
?>
<li>
    <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
        <?php
        $image_url = wp_get_attachment_image_url( $product->get_image_id(), 'full' );
        ?>
        <img class="w-80" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" />
        <h2 class=""><?php echo $product->get_name(); ?></h2>
    </a>
    <div class="">
        <?php echo $product->get_price_html(); ?>
    </div>
</li>
