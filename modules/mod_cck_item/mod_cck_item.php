<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: mod_cck_item.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

$show	=	$params->get( 'url_show', '' );
$hide	=	$params->get( 'url_hide', '' );
if ( $show && JCckDevHelper::matchUrlVars( $show ) === false ) {
	return;
}
if ( $hide && JCckDevHelper::matchUrlVars( $hide ) !== false ) {
	return;
}

// Render
jimport( 'cck.base.item.item' );

$data	=	CCK_Item::render( $params->get( 'id', '' ) );

$raw_rendering		=	$params->get( 'raw_rendering', JCck::getConfig_Param( 'raw_rendering', '1' ) );
$moduleclass_sfx	=	htmlspecialchars( $params->get( 'moduleclass_sfx' ) );
$class_sfx			=	( $params->get( 'force_moduleclass_sfx', 0 ) == 1 ) ? $moduleclass_sfx : '';
require JModuleHelper::getLayoutPath( 'mod_cck_item', $params->get( 'layout', 'default' ) );
?>