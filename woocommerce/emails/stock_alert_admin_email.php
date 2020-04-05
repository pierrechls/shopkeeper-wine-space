<?php
/**
 * Stock Alert Email
 *
 * @author 		Pierre Charles
 * @version   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $WOO_Product_Stock_Alert;

do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php echo _e('A customer has subscribed to a product on your store.', 'wine-space-shopkeeper'); ?></p>
<?php
$product_obj = wc_get_product( $product_id );
if( $product_obj->is_type('variation') ) {
	$parent_id = $product_obj->get_parent_id();
	$product_link = admin_url('post.php?post=' . $parent_id . '&action=edit');
	$product_name = $product_obj->get_formatted_name();
	$product_price = $product_obj->get_price_html();
} else {
	$product_link = admin_url('post.php?post=' . $product_id . '&action=edit');
	$product_name = $product_obj->get_formatted_name();
	$product_price = $product_obj->get_price_html();
}
?>
<h3><?php echo _e('Product details', 'wine-space-shopkeeper'); ?></h3>
<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<thead>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php echo _e('Product', 'wine-space-shopkeeper'); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php echo _e('Price', 'wine-space-shopkeeper'); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( $product_obj->get_name(), 'woocommerce-product-stock-alert' ); ?>
			<?php if($product_obj->get_type() == 'variation'){
              foreach ($product_obj->get_attributes() as $label => $value) {
                echo "<br>".ucfirst(wc_attribute_label($label)).": <strong>".ucfirst($value)."</strong>";
              }
            } ?>
			</th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( $product_price, 'woocommerce-product-stock-alert' ); ?></th>
		</tr>
	</tbody>
</table>

<p style="margin-top: 15px !important;"><?php echo _e('Here is the product link', 'wine-space-shopkeeper'); ?> : <a href="<?php echo $product_link; ?>"><?php echo $product_name; ?></a></p>

<h3><?php echo _e('Customer details', 'wine-space-shopkeeper'); ?></h3>
<p>
	<strong><?php echo _e('Email', 'wine-space-shopkeeper'); ?> : </strong>
	<a target="_blank" href="mailto:<?php echo $customer_email; ?>"><?php echo $customer_email; ?></a>
</p>

<?php do_action( 'woocommerce_email_footer' ); ?>
