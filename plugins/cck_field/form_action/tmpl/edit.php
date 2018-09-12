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

JCckDev::initScript( 'field', $this->item, array( 'hasOptions'=>true ) );
JCckDev::forceStorage();
$options    =   JCckDev::fromSTRING( $this->item->options );
$options2   =   JCckDev::fromJSON( $this->item->options2 );
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_'.$this->item->type.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
        echo JCckDev::renderForm( 'core_bool', $this->item->bool, $config, array( 'defaultvalue'=>0, 'label'=>'Action', 'options'=>'Auto=0||Custom=1' ) );
        echo '<li><label>'.JText::_( 'COM_CCK_ACTION_ANCHOR' ).'</label>'
         .   JCckDev::getForm( 'core_bool2', $this->item->bool2, $config, array( 'defaultvalue'=>0, 'options'=>'None=0||Custom=1||Form ID=2' ) )
         .   JCckDev::getForm( 'core_dev_text', @$options2['anchor'], $config, array( 'defaultvalue'=>'', 'size'=>8, 'storage_field'=>'json[options2][anchor]' ) )
         .   '</li>';
        echo JCckDev::renderForm( 'core_dev_textarea', @$options2['action'], $config, array( 'defaultvalue'=>'', 'label'=>'Action Custom', 'cols'=>92, 'rows'=>1, 'required'=>'required', 'storage_field'=>'json[options2][action]' ), array(), 'w100' );
        
        echo JCckDev::renderForm( 'core_method', @$options2['method'], $config );
        echo JCckDev::renderForm( 'core_bool', @$options2['autocomplete'], $config, array( 'label'=>'Autocomplete', 'defaultvalue'=>'0', 'storage_field'=>'json[options2][autocomplete]' ) );        
        echo JCckDev::renderForm( 'core_menuitem', @$options2['itemid'], $config, array( 'selectlabel'=>'Inherited', 'storage_field'=>'json[options2][itemid]' ) );
        
        echo JCckDev::renderForm( 'core_options_enctype', @$options2['enctype'], $config );
        echo JCckDev::renderForm( 'core_options_target', @$options2['target'], $config, array( 'defaultvalue'=>'_self', 'options'=>'Target Blank=_blank||Target IFrame=iframe||Target Parent=_parent||Target Self=_self||Target Top=_top' ) );

        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_CONSTRUCTION' ), '', 2 );
        echo JCckDev::renderForm( 'core_options', $options, $config, array( 'label'=>'Fields', 'rows'=>1 ) );
        echo JCckDev::renderForm( 'core_bool3', $this->item->bool3, $config, array( 'defaultvalue'=>0, 'label'=>'Exclude System Fields', 'options'=>'No=0||Yes=1||Custom=optgroup||Session Token=2' ) );

		echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#json_options2_action').isVisibleWhen('bool','1');
    $('#json_options2_anchor').isVisibleWhen('bool2','1',false);
    $('#json_options2_enctype').isVisibleWhen('json_options2_method','post');
});
</script>