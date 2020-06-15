<?php
/**
* @version 			SEBLOD 3.x More
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// -- Initialize
require_once __DIR__.'/config.php';
$cck	=	CCK_Rendering::getInstance( $this->template );
if ( $cck->initialize() === false ) { return; }

// -- Prepare
$attributes	=	$cck->replaceLive( $cck->id_attributes );
$class		=	'';
$wrap		=	false;

// -- Render
if ( $cck->id_class != '' ) {
	$class		=	' class="'.trim( $cck->id_class ).'"';
	$wrap		=	true;
} elseif ( $attributes != '' ) {
	$wrap		=	true;
} else {
	$attributes	=	'';
}

if ( $wrap ) { ?>
<div<?php echo $class.$attributes; ?>>
<?php }
if ( $cck->countFields( 'maintop' ) ) {
	$html		=	$cck->renderPosition( 'maintop', '', 0 )
				.	$cck->renderPosition( 'mainbody', 'none', 0 )
				;
	$variation	=	$cck->getVariation( 'mainbody' );

	if ( $html != '' && trim( $variation->name ) ) {
		$html	=	$cck->renderVariation( $variation->name, '', $html, $variation->options, 'mainbody', 0 );
	}

	echo $html;
} else {
	echo $cck->renderPosition( 'mainbody', '', $cck->h( 'mainbody' ) );
}
if ( $wrap ) { ?>
</div>
<?php }

for ( $i = 1; $i <= 5; $i++ ) {
	$suffix	=	( $i == 1 ) ? '' : $i;
	if ( $cck->countFields( 'modal'.$suffix ) ) {
		JHtml::_( 'bootstrap.modal', 'collapseModal'.$suffix );

		$class = $cck->getPosition( 'modal'.$suffix )->css;
		$class = ( $class ) ? ' ' . $class : '';
		?>
		<div class="modal hide fade<?php echo $class; ?>" id="collapseModal<?php echo $suffix; ?>">
			<?php echo $cck->renderPosition( 'modal'.$suffix ); ?>
		</div>
	<?php }
}

if ( $cck->countFields( 'hidden' ) && ( $buffer = $cck->renderPosition( 'hidden' ) ) ) { ?>
	<div style="display: none;">
		<?php echo $buffer; ?>
	</div>
<?php }

// -- Finalize
$cck->finalize();
?>