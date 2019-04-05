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

// Plugin
class plgCCK_Field_LiveJoomla_Language extends JCckPluginLive
{
	protected static $type	=	'joomla_language';
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
		
	// onCCK_Field_LivePrepareForm
	public function onCCK_Field_LivePrepareForm( &$field, &$value = '', &$config = array(), $inherit = array() )
	{
		if ( self::$type != $field->live ) {
			return;
		}
		
		// Init
		$live		=	'';
		$options	=	parent::g_getLive( $field->live_options );
		
		// Prepare
		$variable	=	$options->get( 'language' );
				
		if ( $variable ) {
			$live	=	$variable;
		} else {
			$live	=	JFactory::getLanguage()->getTag();
		}
		
		if ( (int)$options->get( 'all', '0' ) ) {
			$live	.=	',*';
		}

		// Set
		$value	=	$live;
	}
}
?>