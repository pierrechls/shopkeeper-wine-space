<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package   WooCommerce/Templates
 * @version     3.2.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
 
  global $shopkeeper_theme_options;  
 
if ( $max_value && $min_value === $max_value ):?>

	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
<?php else: ?>
 	<?php if ( isset($shopkeeper_theme_options['product_quantity_style']) && $shopkeeper_theme_options['product_quantity_style'] == "custom") : ?>
 
      <div class="quantity custom">
        <a href="#" class="<?php echo is_rtl() ? 'plus-btn' : 'minus-btn' ?>"><i class="spk-icon <?php echo is_rtl() ? 'spk-icon-plus' : 'spk-icon-minus' ?>"></i></a>
        <input onkeyup="this.value=this.value.replace(/[^\d]/,'')" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( $max_value ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text custom-qty text" size="4" />
        <a href="#" class="<?php echo is_rtl() ? 'minus-btn' : 'plus-btn' ?>"><i class="spk-icon <?php echo is_rtl() ? 'spk-icon-minus' : 'spk-icon-plus' ?>"></i></a>
      </div>
 
    <?php else: ?>
 
    <div class="quantity">
      <input type="number" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" pattern="<?php echo esc_attr( $pattern ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" />
    </div>
 
  <?php endif; ?>

<?php endif; ?>
