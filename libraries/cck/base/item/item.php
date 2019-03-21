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
	public static function prepare( $str, $params = null )
	{
		return JHtml::_( 'content.prepare', $str, $params );
	}

	// render
	public static function render( $id, $params = null, $cache = true )
	{
		if ( !(int)$id ) {
			return '';
		}

		$user	=	JFactory::getUser();

		if ( $user->id && !$user->guest ) {
			$cache	=	false;
		}

		if ( $cache ) {
			$suffix	=	'';

			/*
			if ( !is_null( $params ) ) {
				$suffix	=	'_'.md5( json_encode( $params ) );
			}
			*/

			$cache		=	JFactory::getCache( 'cck_item@'.$id.$suffix );
			$cache->setCaching( 1 );

			return $cache->call( array( 'CCK_Item', 'prepare' ), '::cck::'.$id.'::/cck::' );
		} else {
			return self::prepare( '::cck::'.$id.'::/cck::', $params );
		}
	}
}
?>