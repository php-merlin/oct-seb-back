<?php
defined( '_JEXEC' ) or die;

if ( $displayData['parent']->getValue( 'o_nav_item_output_settings' ) ) {
	$settings	=	$displayData['parent']->getValue( 'o_nav_item_output_settings' );
}
?>
<div class="uk-dropdown" uk-dropdown="<?php echo $settings; ?>">
	<?php echo $displayData['html']; ?>
</div>