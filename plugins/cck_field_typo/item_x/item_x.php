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
		$ui				=	plgCCK_FieldItem_X::getFieldProperty( $referrer, 'ui' );

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

		// Set
		$attr	=	'id="'.$value.'_'.$referrer.'" name="'.$referrer.$name_suffix.'" value="'.$value.'"'.$attr;

		if ( $ui ) {
			parent::g_addProcess( 'beforeRenderContent', self::$type, $config, array( 'name'=>$field->name, 'attr'=>$attr, 'referrer'=>$referrer ) );
		}

		return '<input type="hidden" '.$attr.' />';
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Special Events
	
	// onCCK_Field_TypoBeforeRenderContent
	public static function onCCK_Field_TypoBeforeRenderContent( $process, &$fields, &$storages, &$config = array() )
	{
		$name	=	$process['name'];

		if ( isset( $fields[$name] ) ) {
			$checked				=	isset( $fields[$process['referrer'].'_pk'] ) && $fields[$process['referrer'].'_pk']->value ? ' checked="checked"' : '';
			$fields[$name]->typo	=	'<input type="checkbox" '.$process['attr'].$checked.' />';
		}
	}
}
?>