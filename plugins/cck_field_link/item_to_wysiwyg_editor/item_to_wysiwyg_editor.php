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
class plgCCK_Field_LinkItem_To_Wysiwyg_Editor extends JCckPluginLink
{
	protected static $type	=	'item_to_wysiwyg_editor';
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
		
	// onCCK_Field_LinkPrepareContent
	public static function onCCK_Field_LinkPrepareContent( &$field, &$config = array() )
	{		
		if ( self::$type != $field->link ) {
			return;
		}
		
		// Prepare
		$link	=	parent::g_getLink( $field->link_options );
		
		// Set
		$field->link	=	'';
		self::_link( $link, $field, $config );
	}
	
	// _link
	protected static function _link( $link, &$field, &$config )
	{
		$app			=	JFactory::getApplication();
		$type			=	$link->get( 'type', 'link' );
		$editor 		=	$app->input->get( 'editor', '' );

		//
		$field->link	=	'#';
		$params 		=	array( 'name'=>$field->name, 'type'=>$type, 'editor'=>$editor );

		if ( $type == 'link' ) {
			$params['field_link'] 	=	$link->get( 'field_link', '' );
			$params['field_text'] 	=	$link->get( 'field_text', '' );
		}

		parent::g_addProcess( 'beforeRenderContent', self::$type, $config, $params );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Special Events
	
	// onCCK_Field_LinkBeforeRenderContent
	public static function onCCK_Field_LinkBeforeRenderContent( $process, &$fields, &$storages, &$config = array() )
	{
		$name 			=	$process['name'];

		if ( $process['type'] == 'link' ) {

			$field_text 				=	$process['field_text'];
			$link 						=	$fields[$process['field_link']]->link;
			$text 						=	( isset( $fields[$field_text] ) && $fields[$field_text]->value != '' ) ? $fields[$field_text]->value : '';
			$fields[$name]->onclick 	=	'JCck.More.ButtonXtd.insertText(&quot;'.$process['editor'].'&quot;,&quot;'.$link.'&quot;,&quot;'.$text.'&quot;);';
			
		} elseif ( $process['type'] == 'content' ) {
			$fields[$name]->onclick 	=	'JCck.More.ButtonXtd.insertContent(&quot;'.$process['editor'].'&quot;,&quot;'.$config['id'].'&quot;);';
		} else {
			$fields[$name]->onclick 	=	'return false;';
		}

		$fields[$name]->html 		=	str_replace( 'href="#"', 'href="javascript:void(0);" onclick="'.$fields[$name]->onclick.'"', $fields[$name]->html );
	}
}
?>