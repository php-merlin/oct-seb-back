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

jimport( 'cck.base.install.install' );

// Script
class JCckInstallerScriptComponent
{
	protected $cck;
	protected $core;
	
	// install
	public function install( $parent )
	{
	}
	
	// uninstall
	public function uninstall( $parent )
	{
	}
	
	// update
	public function update( $parent )
	{
	}
	
	// preflight
	public function preflight( $type, $parent )
	{
		$this->cck	=	CCK_Install::init( $parent );
	}
	
	// postflight
	public function postflight( $type, $parent )
	{
	}
}
?>