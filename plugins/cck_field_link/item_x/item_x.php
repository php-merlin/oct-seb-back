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
class plgCCK_Field_LinkItem_X extends JCckPluginLink
{
	protected static $type	=	'item_x';
	
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
		$identifier				=	$link->get( 'identifier', 'pk' );
		$link_class				=	$link->get( 'class', '' );
		$link_onclick			=	'';
		$link_title				=	$link->get( 'title', '' );
		$link_title2			=	$link->get( 'title_custom', '' );
		$parent					=	$link->get( 'fieldname', '' );
		$type					=	$link->get( 'type', 'add' );

		// Prepare
		if ( $type == 'save' ) {
			$link_onclick		=	'JCck.More.ItemX.save();';
		} elseif ( $type == 'add' ) {
			$link_onclick		=	'JCck.More.ItemX.setFromClick(this).add();';
		} elseif ( $type == 'select' ) {
			$link_onclick		=	'JCck.More.ItemX.setFromClick(this).select();';
		} elseif ( $type == 'remove' ) {
			$close				=	(int)$link->get( 'close', '0' );
			$close				=	$close ? ',true' : '';
			$link_class			.=	' item_x-remove';
			$link_onclick		=	'JCck.More.ItemX.setFromClick(this,false).remove('.$config[$identifier].$close.');';
		} elseif ( $type == 'process' ) {
			$processing			=	$link->get( 'processing', '' );
			$link_class			.=	' item_x-assign';
			$link_onclick		=	'JCck.More.ItemX.process('.$config['id'].','.$processing.',true);';
		} elseif ( $type == 'assign_multiple' ) {
			$link_onclick		=	'JCck.More.ItemX.assignX();';
		} else {
			$link_class			.=	' item_x-assign';
			$link_onclick		=	'JCck.More.ItemX.assign('.$config[$identifier].',true);';
		}
		$link_class				=	trim( $link_class );
		
		// Confirm?
		if ( $link->get( 'confirm', '0' ) ) {
			$alert					=	$link->get( 'confirm_alert' ); // JText::_( 'COM_CCK_CONFIRM_DELETE' )
			if ( $config['doTranslation'] ) {
				if ( trim( $alert ) ) {
					$alert			=	JText::_( 'COM_CCK_' . str_replace( ' ', '_', trim( $alert ) ) );
				}
			}
			$link_onclick		=	'if(!confirm(\''.addslashes( $alert ).'\')){return false;}else{'.$link_onclick.'}';
		}
		
		// Set
		$field->link			=	'javascript:void(0);';
		$field->link_onclick	=	$link_onclick;
		$field->link_class		=	$link_class ? $link_class : ( isset( $field->link_class ) ? $field->link_class : '' );

		if ( $link_title ) {
			if ( $link_title == '2' ) {
				$field->link_title	=	$link_title2;
			} elseif ( $link_title == '3' ) {
				$field->link_title	=	JText::_( 'COM_CCK_' . str_replace( ' ', '_', trim( $link_title2 ) ) );
			}
			if ( !isset( $field->link_title ) ) {
				$field->link_title	=	'';
			}
		} else {
			$field->link_title		=	'';
		}
	}
}
?>