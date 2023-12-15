<?php

function ProductGrid($numberOfProducts, $orderBy, $order) {
    $args = array(
      'post_type'      => 'product',
      'posts_per_page' => $numberOfProducts,
      'orderby'        => $orderBy,
      'order'          => $order,
    );
  
    $products_query = new WP_Query($args);
  
    if ($products_query->have_posts()) :
    ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php while ($products_query->have_posts()) : $products_query->the_post(); ?>
          <div class="bg-white">
          <a href="<?= esc_url(get_permalink()); ?>" class="">
            <?php
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            ?>
            <div class="mb-4">
              <?php if ($thumbnail_url) : ?>
                <img src="<?= esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-auto rounded-md">
              <?php endif; ?>
            </div>
            <h2 class="text-lg font-semibold mb-2"><?php the_title(); ?></h2>
            <p class="text-gray-600 mb-2"><?= wc_price(get_post_meta(get_the_ID(), '_price', true)); ?></p>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    <?php
      wp_reset_postdata();
    // else :
    //   echo 'No products found';
    endif;
}

function AddToCartSimpleButton() {
    defined( 'ABSPATH' ) || exit;

    global $product;
    $availability = $product->get_availability();
    //print_r($availability);
    if ( ! $product->is_purchasable() ) {
        return;
    }

    if ( $product->is_in_stock() ) : ?>

        <form class="cart" action="<?= esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
            <?php
            woocommerce_quantity_input(
                array(
                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                )
            );
            ?>
            <button type="submit" name="add-to-cart" value="<?= esc_attr( $product->get_id() ); ?>" class="flex max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">
                <?= esc_html( $product->single_add_to_cart_text() ); ?>
            </button>
        </form>
    <?php endif;
}

function AddToCartVariableButton() {
    global $product;
    wp_enqueue_script( 'wc-add-to-cart-variation' );

    $attributes = $product->get_variation_attributes();
    $available_variations = $product->get_available_variations();
    $attribute_keys  = array_keys( $attributes );
    $variations_json = wp_json_encode( $available_variations );
    $variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
    ?>
    <form class="variations_form cart" action="<?= esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?= absint( $product->get_id() ); ?>" data-product_variations="<?= $variations_attr; // WPCS: XSS ok. ?>">

        <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
            <p class="stock out-of-stock"><?= esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
        <?php else : ?>
            <table class="variations" cellspacing="0" role="presentation">
                <tbody>
                    <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                        <tr>
                            <th class="label"><label for="<?= esc_attr( sanitize_title( $attribute_name ) ); ?>"><?= wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></th>
                            <td class="value">
                                <?php
                                    wc_dropdown_variation_attribute_options(
                                        array(
                                            'options'   => $options,
                                            'attribute' => $attribute_name,
                                            'product'   => $product,
                                        )
                                    );
                                    echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="single_variation_wrap">
                <?php
                    /**
                     * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
                     *
                     * @since 2.4.0
                     * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                     * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                     */
                    // this hook works, but disable and replace so can change html myself and tailwind
                    //do_action( 'woocommerce_single_variation' );
                ?>
                <div class="woocommerce-variation single_variation"></div>
                <!-- templates/single-product/add-to-cart/variation.php -->
                
                <script type="text/template" id="tmpl-variation-template">
                    <div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
                    <div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
                    <div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
                </script>
                <script type="text/template" id="tmpl-unavailable-variation-template">
                    <p><?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
                </script>

                <div class="woocommerce-variation-add-to-cart variations_button">
                    <?php
                    woocommerce_quantity_input(
                        array(
                            'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                            'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                            'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                        )
                    );
                    ?>

                    <button type="submit" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

                    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

                    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
                    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
                    <input type="hidden" name="variation_id" class="variation_id" value="0" />
                </div>

            </div>
        <?php endif; ?>
    </form>
    <?php
}

function VariableProductUI()//copy ddelte
{
    // global $product;
    // $attributes = $product->get_variation_attributes();
    // $available_variations = $product->get_available_variations();
    // $attribute_keys  = array_keys( $attributes );
    // $variations_json = wp_json_encode( $available_variations );
    // $variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
    // ?>
    // <form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">

    //     <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
    //         <p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
    //     <?php else : ?>
    //         <table class="variations" cellspacing="0" role="presentation">
    //             <tbody>
    //                 <?php foreach ( $attributes as $attribute_name => $options ) : ?>
    //                     <tr>
    //                         <th class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></th>
    //                         <td class="value">
    //                             <?php
    //                                 wc_dropdown_variation_attribute_options(
    //                                     array(
    //                                         'options'   => $options,
    //                                         'attribute' => $attribute_name,
    //                                         'product'   => $product,
    //                                     )
    //                                 );
    //                                 echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
    //                             ?>
    //                         </td>
    //                     </tr>
    //                 <?php endforeach; ?>
    //             </tbody>
    //         </table>
    //         <div class="single_variation_wrap">
    //             <?php
    //                 /**
    //                  * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
    //                  *
    //                  * @since 2.4.0
    //                  * @hooked woocommerce_single_variation - 10 Empty div for variation data.
    //                  * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
    //                  */
    //                 do_action( 'woocommerce_single_variation' );
    //             ?>
    //         </div>
    //     <?php endif; ?>
    // </form>
    // <?php
}
?>