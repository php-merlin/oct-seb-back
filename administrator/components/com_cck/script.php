<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: script.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.folder' );

// Script
class com_cckInstallerScript
{
	// uninstall
	public function uninstall( $parent )
	{
		$app	=	JFactory::getApplication();
		$db		=	JFactory::getDbo();
		$db->setQuery( 'SELECT extension_id FROM #__extensions WHERE type = "package" AND element = "pkg_cck"' );
		$eid	=	$db->loadResult();
		
		$db->setQuery( 'SELECT extension_id FROM #__extensions WHERE type = "plugin" AND element = "cck" AND folder="system"' );
		$cck	=	$db->loadResult();
		
		// Backup or Drop SQL Tables
		$prefix			=	$db->getPrefix();
		$tables			=	$db->getTableList();
		$tables			=	array_flip( $tables );
		$uninstall_sql	=	(int)JCck::getConfig_Param( 'uninstall_sql', '' );

		if ( count( $tables ) ) {
			$length			=	strlen( $prefix );
			$app->cck_nosql	=	true;
			
			foreach ( $tables as $k=>$v ) {
				$pos		=	strpos( $k, $prefix.'cck_' );

				if ( $pos !== false && $pos == 0 ) {
					$k2		=	$prefix.'_'.substr( $k, $length );

					if ( isset( $tables[$k2] ) ) {
						$db->setQuery( 'DROP TABLE '.$k2 );
						$db->execute();
					}
					if ( $uninstall_sql == 1 ) {
						$db->setQuery( 'DROP TABLE '.$k );
						$db->execute();
					} else {
						$db->setQuery( 'RENAME TABLE '.$k.' TO '.$k2 );
						$db->execute();
					}
				}
			}
		}

		// Uninstall FULL PACKAGE only if package exists && system plugin exists..
		if ( $eid && $cck ) {
			$manifest	=	JPATH_ADMINISTRATOR.'/manifests/packages/pkg_cck.xml';
			if ( JFile::exists( $manifest ) ) {
				$xml	=	JFactory::getXML( $manifest ); // Keep it this way until platform 13.x
			}
			if ( isset( $xml->files ) ) {
				unset( $xml->files->file[3] );
				$xml->asXML( $manifest );
			}
			
			jimport( 'joomla.installer.installer' );
			$installer	=	JInstaller::getInstance();
			$installer->uninstall( 'package', $eid );
		}
	}
	
	// update
	public function update( $parent )
	{
		// WAITING FOR JOOMLA 1.7.x FIX
		$app		=	JFactory::getApplication();
		$config		=	JFactory::getConfig();
		$tmp_path	=	$config->get( 'tmp_path' );
		$tmp_dir 	=	uniqid( 'cck_var_' );
		$path 		= 	$tmp_path.'/'.$tmp_dir;
		$src		=	JPATH_SITE.'/libraries/cck/rendering/variations';
		if ( JFolder::exists( $src ) ) {
			JFolder::copy( $src, $path );
			$app->cck_core_temp_var	=	$tmp_dir;
		}
		// WAITING FOR JOOMLA 1.7.x FIX
	}
	
	// preflight
	public function preflight( $type, $parent )
	{
		$app	=	JFactory::getApplication();
		
		$app->cck_core				=	true;
		$app->cck_core_version_old	=	self::_getVersion();
	}
	
	// postflight
	public function postflight( $type, $parent )
	{
		$app	=	JFactory::getApplication();
		$db		=	JFactory::getDbo();
		
		$app->cck_core_version		=	self::_getVersion();
		
		// Additional stuff: /cli
		$src	=	JPATH_ADMINISTRATOR.'/components/com_cck/install/cli/cck_job.php';

		if ( JFile::exists( $src ) ) {
			JFile::delete( JPATH_SITE.'/cli/cck_job.php' );
			JFile::copy( $src, JPATH_SITE.'/cli/cck_job.php' );
			JFolder::delete( JPATH_ADMINISTRATOR.'/components/com_cck/install/cli/' );
		}

		// Additional stuff: raw.php
		$src	=	JPATH_ADMINISTRATOR.'/components/com_cck/install/tmpl/raw.php';
		$dest	=	JPATH_ADMINISTRATOR.'/templates/'.$app->getTemplate().'/raw.php';

		if ( JFile::exists( $src ) ) {
			if ( !JFile::exists( $dest ) ) {
				JFile::copy( $src, $dest );
			}
			$query	=	$db->getQuery( true );
			$query->select( $db->quoteName( array( 'template' ) ) )
				  ->from( $db->quoteName( '#__template_styles' ) )
				  ->where( $db->quoteName( 'client_id' ) . ' = 0' )
				  ->where( $db->quoteName( 'home' ) . ' = 1' );
			$db->setQuery( $query );
		
			if ( $site_template = $db->loadResult() ) {
				$dest	=	JPATH_SITE.'/templates/'.$site_template.'/raw.php';
				if ( !JFile::exists( $dest ) ) {
					JFile::copy( $src, $dest );
				}
			}
			JFolder::delete( JPATH_ADMINISTRATOR.'/components/com_cck/install/tmpl/' );
		}

		// Additional stuff: /cms
		$src	=	JPATH_ADMINISTRATOR.'/components/com_cck/install/cms';
		
		if ( JFolder::exists( $src ) ) {
			JFolder::copy( $src, JPATH_SITE.'/libraries/cms/cck', '', true );
			JFolder::delete( $src );
		}

		// Additional stuff: /sql
		$src	=	JPATH_ADMINISTRATOR.'/components/com_cck/install/sql/updates';
		
		if ( JFolder::exists( $src ) ) {
			JFolder::copy( $src, JPATH_ADMINISTRATOR.'/manifests/packages/cck/updates', '', true );
			JFolder::delete( $src );
		}

		// Additional stuff: /project
		if ( $type == 'install' ) {	
			$src	=	JPATH_ADMINISTRATOR.'/components/com_cck/install/project';
			
			if ( JFolder::exists( $src ) ) {
				if ( !JFolder::exists( JPATH_SITE.'/project' ) ) {
					JFolder::copy( $src, JPATH_SITE.'/project', '', true );
				}
				JFolder::delete( $src );
			}
		}
	}
	
	// _getVersion
	protected static function _getVersion( $default = '2.0.0' )
	{
		$db		=	JFactory::getDbo();
		
		$db->setQuery( 'SELECT manifest_cache FROM #__extensions WHERE element = "com_cck" AND type = "component"' );
		
		$res		=	$db->loadResult();
		$registry	=	new JRegistry;
		$registry->loadString( $res );
		
		return $registry->get( 'version', $default );
	}
}
?>