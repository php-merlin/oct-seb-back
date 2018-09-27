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
class plgCCK_Field_ValidationX extends JCckPluginValidation
{
	protected static $type	=	'x';
	protected static $regex	=	'';
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare

	// onCCK_Field_ValidationPrepareForm
	public static function onCCK_Field_ValidationPrepareForm( &$field, $fieldId, &$config )
	{
		if ( self::$type != $field->validation ) {
			return;
		}

		$validation		=	parent::g_getValidation( $field->validation_options, false );
		$validations	=	$validation->toArray();
		
		if ( isset( $validations['conditions'] ) && count( $validations['conditions'] ) ) {
			$options	=	$field->validation_options;
			
			foreach ( $validations['conditions'] as $condition ) {
				$field->validation			=	$condition['trigger'];
				$field->validation_options	=	json_encode( $condition['options'] );

				if ( is_file( JPATH_PLUGINS.'/cck_field_validation/'.$condition['trigger'].'/'.$condition['trigger'].'.php' ) ) {
					require_once JPATH_PLUGINS.'/cck_field_validation/'.$condition['trigger'].'/'.$condition['trigger'].'.php';	
				}
				JCck::callFunc_Array( 'plgCCK_Field_Validation'.$condition['trigger'], 'onCCK_Field_ValidationPrepareForm', array( &$field, $fieldId, &$config ) );
			}
			$field->validation			=	'x';
			$field->validation_options	=	$options;
		}
	}
	
	// onCCK_Field_ValidationPrepareStore
	public static function onCCK_Field_ValidationPrepareStore( &$field, $name, $value, &$config )
	{
		/* TODO#SEBLOD: */
	}
}
?>