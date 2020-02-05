<?php
/**
* @version 			SEBLOD 3.x Core
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

require_once JPATH_SITE.'/plugins/cck_storage_location/free/free.php';

// Class
class plgCCK_Storage_LocationFree_Helper extends plgCCK_Storage_LocationFree
{
	// getForm
	public static function getAssociationsForm( $id, $name, $field, $config = array() )
	{
		$addform	=	new SimpleXMLElement( '<form />' );
		$fields		=	$addform->addChild( 'fields' );
		$fields->addAttribute( 'name', $name );
		$fieldset	=	$fields->addChild( 'fieldset' );
		$fieldset->addAttribute( 'name', 'item_associations' );
		$fieldset->addAttribute( 'description', 'COM_CONTENT_ITEM_ASSOCIATIONS_FIELDSET_DESC' );
		$fieldset->addAttribute( 'addfieldpath', '/administrator/components/com_content/models/fields' );
		$hasForm	=	false;
		$languages	=	JLanguageHelper::getLanguages( 'lang_code' );
		
		foreach ( $languages as $tag=>$language ) {
			if ( empty( $config['language'] ) || $tag != $config['language'] ) {
				$hasForm	=	true;
				$f			=	$fieldset->addChild( 'field' );
				$f->addAttribute( 'name', $tag );
				$f->addAttribute( 'type', 'text' );
				$f->addAttribute( 'language', $tag );
				$f->addAttribute( 'label', $language->title );
				$f->addAttribute( 'translate_label', 'false' );
			}
		}

		$context	=	'com_cck.free';

		if ( $field->storage_table ) {
			$context	.=	'.'.$field->storage_table;
		}

		$form		=		JForm::getInstance( $id, $addform->asXML() );

		if ( $hasForm ) {
			$form->load( $addform, false );
			$table_name	=	'';

			if ( isset( $config['base']->table ) ) {
				$table_name	=	$config['base']->table;
			}
			
			$associations	=	JLanguageAssociations::getAssociations( 'com_cck', $table_name, $context, $config['pk'], 'id', '', '' );

			if ( count( $associations ) ) {
				foreach ( $associations as $tag=>$association ) {
					$form->setValue( $tag, $name, $association->id );
				}
			}
			if ( $config['copyfrom_id'] && isset( $config['translate'] ) ) {
				$form->setValue( $config['translate'], $name, $config['copyfrom_id'] );
			}
		}
		
		// Render Form
		$fields	=	$form->getFieldset( 'item_associations' );
		$form	=	'';
		foreach ( $fields as $f ) {
			$form	.=	'<div class="control-group"><div class="control-label">'.$f->label.'</div><div class="controls">'.$f->input.'</div></div>';
		}
		
		return $form;
	}
}
?>