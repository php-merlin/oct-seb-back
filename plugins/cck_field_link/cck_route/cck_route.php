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
class plgCCK_Field_LinkCck_Route extends JCckPluginLink
{
	protected static $type	=	'cck_route';
	
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
		$fieldnames		=	array();
		$mode			=	(int)$link->get( 'mode', '0' );

		if ( $mode ) {
			$group_name	=	$link->get( 'routes_fieldname', '' );
			
			if ( $group_name ) {
				$client	=	( $config['client'] == 'list' || $config['client'] == 'item' ) ? 'intro' : $config['client'];

				if ( isset( $config['client_form'] ) && $config['client_form'] ) {
					$client	=	$config['client_form'];
				}

				$query	=	' SELECT a.name'
						.	' FROM #__cck_core_fields AS a'
						.	' LEFT JOIN #__cck_core_type_field AS c ON c.fieldid = a.id'
						.	' LEFT JOIN #__cck_core_types AS b ON b.id = c.typeid'
						.	' WHERE b.name = "'.$group_name.'" AND c.client = "'.$client.'"'
						.	$order
						;
				$fieldnames	=	JCckDatabaseCache::loadColumn( $query );
			}
		} else {
			$fieldnames	=	$link->get( 'routes', '' );
			$fieldnames	=	explode( '||', $fieldnames );
		}

		// Prepare
		$link_attr		=	$link->get( 'attributes', '' );
		$link_class		=	$link->get( 'class', '' );
		$link_rel		=	$link->get( 'rel', '' );
		$link_target	=	$link->get( 'target', '' );
		
		if ( count( $fieldnames ) ) {
			parent::g_addProcess( 'beforeRenderContent', self::$type, $config, array( 'name'=>$field->name, 'fieldnames'=>$fieldnames ), 5 );
		}
		
		$field->link			=	'';
		$field->link_attributes	=	$link_attr ? $link_attr : ( isset( $field->link_attributes ) ? $field->link_attributes : '' );
		$field->link_class		=	$link_class ? $link_class : ( isset( $field->link_class ) ? $field->link_class : '' );
		$field->link_rel		=	$link_rel ? $link_rel : ( isset( $field->link_rel ) ? $field->link_rel : '' );
		$field->link_state		=	$link->get( 'state', 1 );
		$field->link_target		=	$link_target ? $link_target : ( isset( $field->link_target ) ? $field->link_target : '' );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Special Events
	
	// onCCK_Field_LinkBeforeRenderContent
	public static function onCCK_Field_LinkBeforeRenderContent( $process, &$fields, &$storages, &$config = array() )
	{
		$name	=	$process['name'];
		$route	=	'';
		
		if ( count( $process['fieldnames'] ) ) {
			foreach ( $process['fieldnames'] as $fieldname ) {
				if ( isset( $fields[$fieldname] ) && $fields[$fieldname]->link != '' && $fields[$fieldname]->state ) {
					$route	=	$fields[$fieldname]->link;

					break;
				}
			}
		}
		
		if ( $route != '' ) {
			$fields[$name]->link	=	$route;
			$target					=	 $fields[$name]->typo_target;
			
			if ( is_array( $fields[$name]->$target ) ) {
				foreach ( $fields[$name]->$target as $k=>$v ) {
					if ( is_object( $v ) && $v->state ) {
						$fields[$name]->{$target}[$k]->link			=	$fields[$name]->link;
						$fields[$name]->{$target}[$k]->link_state	=	1;
					}
				}
			}
			
			JCckPluginLink::g_setHtml( $fields[$name], $target );
		}
	}
}
?>