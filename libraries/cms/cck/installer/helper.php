<?php
/**
* @version 			SEBLOD 3.x Core
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// Script
abstract class JCckInstallerHelper
{
	// runSql
	public static function runSql( $path, $params )
	{
		$app		=	JFactory::getApplication();
		$db			=	JFactory::getDbo();

		$files		=	JFolder::files( $path, '.', true, true, array( 'index.html' ) );
		$latest		=	$params->get( 'latest_update', '' );
		$now		=	'';
		$versions	=	array();

		if ( count( $files ) ) {
			foreach ( $files as $file ) {
				if ( is_file( $file ) ) {
					$datetime	=	'';
					$name		=	substr( basename( $file ), 0, -4 );
					$pos		=	strpos( $name, '-' );
					$version	=	'';

					if ( $pos !== false ) {
						$parts		=	explode( '-', $name );
						$datetime	=	substr( $name, $pos + 1 );
						$version	=	substr( $name, 0, $pos );
					} else {
						$version	=	$name;
					}

					if ( version_compare( $version, $app->cck_core_version_old, '<' ) ) {
						continue;
					} elseif ( version_compare( $version, $app->cck_core_version_old, '=' ) ) {
						if ( $datetime == '' ) {
							continue;
						}
						if ( $latest != '' ) {
							$date1		=	new DateTime( $datetime, new DateTimeZone( 'UTC' ) );
							$date1->setTime( 00, 00, 00 );
							$date2		=	new DateTime( $latest, new DateTimeZone( 'UTC' ) );
							$date2->setTime( 00, 00, 00 );

        					if ( $date1 <= $date2 ) {
        						continue;
        					} else {
        						$now	=	$datetime;
        					}
    					}
					}
					if ( version_compare( $version, $app->cck_core_version, '>' ) ) {
						continue;
					}

					$idx	=	(float)str_replace( '.', '', $version );

					if ( !isset( $versions[$idx] ) ) {
						$versions[$idx]	=	array();
					}
					$versions[$idx][]	=	$file;
				}
			}
		}
		ksort( $versions );
		
		if ( count( $versions ) ) {
			foreach ( $versions as $version ) {
				if ( count( $version ) ) {
					foreach ( $version as $item ) {
						if ( is_file( $item ) ) {
							$buffer		=	file_get_contents( $item );
							$queries	=	JInstallerHelper::splitSql( $buffer );
							
							foreach ( $queries as $query ) {
								$query	=	trim( $query );
								if ( $query != '' && $query{0} != '#' ) {
									$db->setQuery( $query );
									$db->execute();
								}
							}
						}
					}
				}
			}
		}

		$date1		=	new DateTime( $now, new DateTimeZone( 'UTC' ) );
		$date1->setTime( 00, 00, 00 );
		$date2		=	new DateTime( 'now', new DateTimeZone( 'UTC' ) );
		$date2->setTime( 00, 00, 00 );
		
		if ( $date1 < $date2 ) {
			$now	=	'now';
		}

		return $now;
	}
}
?>