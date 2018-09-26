<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: mod_cck_form.php sebastienheraud $
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

$app	=	JFactory::getApplication();
$cache	=	true;
$data	=	$params->get( 'id', '' );

// Render
jimport( 'cck.base.item.item' );

if ( $cache ) {
	$cache		=	JFactory::getCache( 'mod_cck_item@'.$data );
	$cache->setCaching( 1 );
	$data		=	$cache->call( array( 'CCK_Item', 'prepare' ), '::cck::'.$data.'::/cck::' );
} else {
	$data		=	CCK_Item::prepare( '::cck::'.$data.'::/cck::' );
}

$raw_rendering		=	$params->get( 'raw_rendering', JCck::getConfig_Param( 'raw_rendering', '0' ) );
$moduleclass_sfx	=	htmlspecialchars( $params->get( 'moduleclass_sfx' ) );
$class_sfx			=	( $params->get( 'force_moduleclass_sfx', 0 ) == 1 ) ? $moduleclass_sfx : '';
require JModuleHelper::getLayoutPath( 'mod_cck_item', $params->get( 'layout', 'default' ) );
?>