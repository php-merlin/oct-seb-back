<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: batch.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

JLoader::register( 'JTableContent', JPATH_PLATFORM.'/joomla/database/table/content.php' );

// JCckTableContent
class JCckTableContent extends JTableContent
{
	// __construct
	public function __construct( JDatabaseDriver $db )
	{
		parent::__construct( $db );

		$this->_trackAssets	=	false;
	}

	// setRules
	public function setRules( $input )
	{
		if ( (string)$input != '{}' ) {
			$this->_trackAssets	=	true;
		}

		parent::setRules( $input );
	}
}
?>