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
class plgCCK_Field_TypoItem_X extends JCckPluginTypo
{
	protected static $type	=	'item_x';
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
		
	// onCCK_Field_TypoPrepareContent
	public function onCCK_Field_TypoPrepareContent( &$field, $target = 'value', &$config = array() )
	{		
		if ( self::$type != $field->typo ) {
			return;
		}
		
		// Prepare
		$typo	=	parent::g_getTypo( $field->typo_options );
		$value	=	parent::g_hasLink( $field, $typo, $field->$target );
		
		// Set
		if ( $field->typo_label ) {
			$field->label	=	self::_typo( $typo, $field, $field->label, $config );
		}
		$field->typo		=	self::_typo( $typo, $field, $value, $config );
	}
	
	// _typo
	protected static function _typo( $typo, $field, $value, &$config = array() )
	{
		$app		=	JFactory::getApplication();
		$attr		=	' data-cck-remove-before-search=""';
		$value		=	$field->value; /* We may need a parameter to cast as (int) */
		$referrer	=	$app->input->getCmd( 'cck_item_x_referrer', $app->input->getCmd( 'referrer', uniqid() ) );
		
		// Prepare
		$mode			=	(int)plgCCK_FieldItem_X::getFieldProperty( $referrer, 'mode' );
		$name_suffix	=	$mode ? '[]' : '';

		if ( strpos( $referrer, '.' ) !== false ) {
			$parts		=	explode( '.', $referrer );
			$referrer	=	$parts[2];

			if ( $parts[1] == 'search' ) {
				$attr	=	'';
			}
		}
		
		if ( !$value ) {
			return '';
		}

		return '<input type="hidden" id="'.$value.'_'.$referrer.'" name="'.$referrer.$name_suffix.'" value="'.$value.'"'.$attr.' />';
	}
}
?>