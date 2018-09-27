<?php
/**
* @version          SEBLOD 3.x More
* @package          SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor           Octopoos - www.octopoos.com
* @copyright        Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license          GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

//JCckDev::initScript( 'validation', $this->item );
// require_once JPATH_COMPONENT.'/helpers/helper_admin.php';
/*
$validations    =   array_merge( array( JHtml::_( 'select.option', '', JText::_( 'COM_CCK_NONE' ) ) ), Helper_Admin::getPluginOptions( 'field_validation', 'cck_', false, false, true, array( 'required' ) ) );

if ( count( $validations ) ) {
    foreach ( $validations as $k=>$v ) {
        if ( $v->value == 'x' ) {
            unset( $validations[$k] );
        }
    }
}
$html           =   JHtml::_( 'select.genericlist', $validations, 'validation', 'class="validations"', 'value', 'text', '', 'validation_id' );

echo '<li><label>'.JText::_( 'COM_CCK_VALIDATION' ).'</label>'.$html.'<span class="c_res hide">+</span></li>';
echo '<li class="w100"><label>JSON</label><textarea id="restriction_options_id" cols="88" rows="1" class="restrictions_options"></textarea></li>';
echo '</ul>';
*/
echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'JSON', 'rows'=>1, 'cols'=>88, 'required'=>'required', 'storage_field'=>'conditions' ), array(), 'w100' );
?>