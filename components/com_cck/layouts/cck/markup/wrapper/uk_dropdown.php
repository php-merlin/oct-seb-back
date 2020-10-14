<?php
defined( '_JEXEC' ) or die;

if ( $displayData['parent']->getValue( 'o_nav_item_output_settings' ) ) {
	$settings	=	$displayData['parent']->getValue( 'o_nav_item_output_settings' );
} else {
	$settings	=	'pos: bottom-justify;animation: uk-animation-slide-top-small; duration: 300';
}
?>
<div class="uk-dropdown" uk-dropdown="<?php echo $settings; ?>">
	<?php echo $displayData['html']; ?>
</div>