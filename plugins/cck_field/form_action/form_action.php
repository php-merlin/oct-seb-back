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
class plgCCK_FieldForm_Action extends JCckPluginField
{
	protected static $type		=	'form_action';
	protected static $path;
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Construct
	
	// onCCK_FieldConstruct
	public function onCCK_FieldConstruct( $type, &$data = array() )
	{
		if ( self::$type != $type ) {
			return;
		}
		parent::g_onCCK_FieldConstruct( $data );
		$data['display']	=	0;
	}
	
	// onCCK_FieldConstruct_SearchSearch
	public static function onCCK_FieldConstruct_SearchSearch( &$field, $style, $data = array(), &$config = array() )
	{
		$data['conditional']	=	null;
		$data['label']			=	null;
		$data['match_mode']		=	null;
		$data['live']			=	null;
		$data['markup']			=	null;
		$data['markup_class']	=	null;
		$data['validation']		=	null;
		$data['variation']		=	null;

		parent::onCCK_FieldConstruct_SearchSearch( $field, $style, $data, $config );
	}

	// onCCK_FieldConstruct_TypeForm
	public static function onCCK_FieldConstruct_TypeForm( &$field, $style, $data = array(), &$config = array() )
	{
		$data['computation']	=	null;
		$data['conditional']	=	null;
		$data['label']			=	null;
		$data['live']			=	null;
		$data['markup']			=	null;
		$data['markup_class']	=	null;
		$data['validation']		=	null;
		$data['variation']		=	null;
		
		parent::onCCK_FieldConstruct_TypeForm( $field, $style, $data, $config );
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
	
	// onCCK_FieldPrepareContent
	public function onCCK_FieldPrepareContent( &$field, $value = '', &$config = array() )
	{
		if ( self::$type != $field->type ) {
			return;
		}
	}
	
	// onCCK_FieldPrepareForm
	public function onCCK_FieldPrepareForm( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		self::$path	=	parent::g_getPath( self::$type.'/' );
		parent::g_onCCK_FieldPrepareForm( $field, $config );
		
		if ( $field->state ) {
			// Init
			if ( count( $inherit ) ) {
				$id		=	( isset( $inherit['id'] ) && $inherit['id'] != '' ) ? $inherit['id'] : $field->name;
				$name	=	( isset( $inherit['name'] ) && $inherit['name'] != '' ) ? $inherit['name'] : $field->name;
			} else {
				$id		=	$field->name;
				$name	=	$field->name;
			}

			if ( (string)$field->variation != 'hidden' ) {
				$app			=	JFactory::getApplication();
				$options2		=	new JRegistry( $field->options2 );

				$class			=	( $field->css ? ' class="'.$field->css.'"' : '' );
				$autocomplete	=	$options2->get( 'autocomplete', 0 ) ? 'on' : 'off';
				$action			=	$options2->get( 'action', '' );
				$enctype		=	$options2->get( 'enctype', '' );
				$itemId			=	$options2->get( 'itemid', '' );
				$method			=	$options2->get( 'method', 'get' );
				$target			=	$options2->get( 'target', '_self' );
				
				if ( $field->bool ) {
					//
				} else {
					if ( $itemId ) {
						$action		=	 JRoute::_( 'index.php?Itemid='.$itemId );
					} else {
						$action		=	 JRoute::_( 'index.php?option='.JFactory::getApplication()->input->get( 'option' ) );
					}
				}
				if ( $field->bool2 == '2' ) {
					$action			.=	'#'.$config['formId'];
				} elseif ( $field->bool2 == '1' ) {
					$action			.=	$options2->get( 'anchor', '' );
				}
		 		$enctype			=	( $enctype && $method == 'post' ) ? ' enctype="'.$enctype.'"' : '';
				$target				=	( $target ) ? ' target="'.$target.'"' : '';
				$config['action']	=	'<form'.$enctype.$target.' action="'.$action.'" autocomplete="'.$autocomplete.'" method="'.$method.'" id="'.$config['formId'].'" name="'.$config['formId'].'"'.$class.'>'; // accept-charset="ISO-8859-1"
				$config['core']		=	(int)$field->bool3;
				
				if ( $field->options ) {
					parent::g_addProcess( 'beforeRenderForm', self::$type, $config, array( 'name'=>$name, 'options'=>$field->options ) );
				}
			}
		}
		$field->form	=	'';
		$field->value	=	'';
		
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
	
	// onCCK_FieldBeforeRenderForm
	public static function onCCK_FieldBeforeRenderForm( $process, &$fields, &$storages, &$config = array() )
	{
		$options	=	$process['options'];
		$opts		=	explode( '||', $options );
		
		if ( count( $opts ) ) {
			foreach ( $opts as $opt ) {
				$o	=	explode( '=', $opt );
				
				if ( isset( $fields[$o[0]] ) ) {
					$fields[$o[0]]->form	=	str_replace( 'name="'.$o[0].'"', 'name="'.$o[1].'"', $fields[$o[0]]->form );
					$fields[$o[0]]->form	=	str_replace( 'name="'.$o[0].'[]"', 'name="'.$o[1].'"', $fields[$o[0]]->form );
				}
			}
		}
	}
}
?>