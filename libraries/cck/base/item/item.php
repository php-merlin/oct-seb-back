<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: item.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// Item
class CCK_Item
{
	// prepare
	public static function prepare( $str )
	{
		return JHtml::_( 'content.prepare', $str );
	}

	// render
	public static function render( $id, $cache = true )
	{
		if ( !(int)$id ) {
			return '';
		}
		
		if ( $cache ) {
			$cache		=	JFactory::getCache( 'cck_item@'.$id );
			$cache->setCaching( 1 );

			return $cache->call( array( 'CCK_Item', 'prepare' ), '::cck::'.$id.'::/cck::' );
		} else {
			return self::prepare( '::cck::'.$id.'::/cck::' );
		}
	}
}
?>