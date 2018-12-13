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
class plgCCK_FieldMessage_Redirection extends JCckPluginField
{
	protected static $type	=	'message_redirection';
	protected static $path;
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Construct
	
	// onCCK_FieldConstruct
	public function onCCK_FieldConstruct( $type, &$data = array() )
	{
		if ( self::$type != $type ) {
			return;
		}
		parent::g_onCCK_FieldConstruct( $data );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
	
	// onCCK_FieldPrepareContent
	public function onCCK_FieldPrepareContent( &$field, $value = '', &$config = array() )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		parent::g_onCCK_FieldPrepareContent( $field, $config );

		// Prepare
		if ( $field->state ) {
			parent::g_addProcess( 'beforeRenderContent', self::$type, $config, array( 'name'=>$field->name, 'options2'=>$field->options2 ), 5 );
		}

		// Set
		$field->value	=	'';
	}
	
	// onCCK_FieldPrepareForm
	public function onCCK_FieldPrepareForm( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		self::$path	=	parent::g_getPath( self::$type.'/' );
		parent::g_onCCK_FieldPrepareForm( $field, $config );
		
		// Set
		$field->display	=	0;
		$field->form	=	'';
		$field->value	=	$value;
		
		// Return
		if ( $return === true ) {
			return $field;
		}
	}
	
	// onCCK_FieldPrepareSearch
	public function onCCK_FieldPrepareSearch( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		
		// Prepare
		self::onCCK_FieldPrepareForm( $field, $value, $config, $inherit, $return );
		
		// Return
		if ( $return === true ) {
			return $field;
		}
	}
	
	// onCCK_FieldPrepareStore
	public function onCCK_FieldPrepareStore( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}

		/*
		// Init
		if ( count( $inherit ) ) {
			$name	=	( isset( $inherit['name'] ) && $inherit['name'] != '' ) ? $inherit['name'] : $field->name;
		} else {
			$name	=	$field->name;
		}

		parent::g_onCCK_FieldPrepareStore( $field, $name, $value, $config );

		if ( !$field->state ) {
			return;
		}
		*/

		// Prepare
		$options2	=	json_decode( $field->options2 );

		if ( is_object( $options2 ) && isset( $options2->itemid ) && $options2->itemid ) {
			$url	=	JCckDevHelper::getAbsoluteUrl( $options2->itemid );

			if ( $url != '' ) {
				$config['options']['redirection']	=	'';
				$config['url']						=	$url;
			}
		}
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Render
	
	// onCCK_FieldRenderContent
	public static function onCCK_FieldRenderContent( $field, &$config = array() )
	{
		return parent::g_onCCK_FieldRenderContent( $field );
	}
	
	// onCCK_FieldRenderForm
	public static function onCCK_FieldRenderForm( $field, &$config = array() )
	{
		return parent::g_onCCK_FieldRenderForm( $field );
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Special Events
	
	// onCCK_FieldBeforeRenderContent
	public static function onCCK_FieldBeforeRenderContent( $process, &$fields, &$storages, &$config = array() )
	{
		$name	=	$process['name'];

		if ( !$fields[$name]->state ) {
			return;
		}
		
		self::_process( $process, $fields );
	}

	// onCCK_FieldBeforeRenderForm
	public static function onCCK_FieldBeforeRenderForm( $process, &$fields, &$storages, &$config = array() )
	{
		$name	=	$process['name'];

		if ( !$fields[$name]->state ) {
			return;
		}
		
		self::_process( $process, $fields );
	}

	// _process
	protected static function _process( $process, &$fields )
	{

		$options2	=	json_decode( $process['options2'] );

		if ( !is_object( $options2 ) ) {
			return;
		}

		if ( isset( $options2->message_style ) && $options2->message_style ) {
			$message	=	'Message';
		}
		if ( isset( $options2->itemid ) && $options2->itemid ) {
			$itemId	=	$options2->itemid;

			if ( $itemId == -1 ) {
				$itemId	=	JFactory::getApplication()->input->getInt( 'Itemid' );
			}
			if ( isset( $options2->timeout ) && $options2->timeout == 0 ) {
				JFactory::getApplication()->redirect( JCckDevHelper::getAbsoluteUrl( $itemId ) );
			} else {
				$redirection	=	'document.location.href=\''.JCckDevHelper::getAbsoluteUrl( $itemId ).'\'';
			
				JFactory::getDocument()->addScriptDeclaration( 'setTimeout("'.$redirection.'",'.$options2->timeout_ms.');' );
			}
		}
		if ( $message ) {
			JFactory::getApplication()->enqueueMessage( $message, $options2->message_style );
		}
	}
}
?>