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

JCckDev::initScript( 'field', $this->item, array( 'hasOptions'=>true, 'doTranslation'=>1, 'customAttr'=>JCck::getConfig_Param( 'development_attr', 6 ) ) );

// Set
$displayData	=	array(
						'config'=>$config,
						'form'=>array(
							array(
								'fields'=>array(
									JCckDev::renderForm( 'core_label', $this->item->label, $config ),
									JCckDev::renderForm( 'core_defaultvalue', $this->item->defaultvalue, $config ),
									JCckDev::renderForm( 'core_selectlabel', $this->item->selectlabel, $config ),
									JCckDev::renderForm( 'core_sorting', $this->item->sorting, $config ),
									JCckDev::renderForm( 'core_options', JCckDev::fromSTRING( $this->item->options ), $config )
								)
							),
							array(
								'fields'=>array(
									JCckDev::getForm( 'core_storage', $this->item->storage, $config )
								),
								'mode'=>'storage'
							)
						),
						'help'=>array( 'field', 'seblod-2-x-select-simple-field' ),
						'html'=>'',
						'item'=>$this->item,
						'script'=>'',
						'type'=>'field'
					);

echo JCckDev::renderLayoutFile( 'cck'.JCck::v().'.construction.cck_field.edit', $displayData );
?>