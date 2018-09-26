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

$locations  =   explode( '||', $this->item->location );
$options2   =   JCckDev::fromJSON( $this->item->options2 );
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_'.$this->item->type.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
        echo JCckDev::renderForm( 'core_label', $this->item->label, $config );
        echo JCckDev::renderForm( 'core_extended', $this->item->extended, $config, array( 'label'=>_C4_TEXT ) );
        echo JCckDev::renderForm( 'core_bool', $this->item->bool, $config, array( 'label'=>'Behavior', 'defaultvalue'=>'0', 'options'=>'Standard=0||Multiple=1' ) );

        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_ADD' ) );
        echo JCckDev::renderForm( 'core_bool2', $this->item->bool2, $config, array( 'label'=>'Mode', 'defaultvalue'=>'-2', 'options'=>'None=-2||Modal Box=0' ) );
        echo JCckDev::renderForm( 'core_extended', @$locations[0], $config, array( 'label'=>_C2_TEXT, 'storage_field'=>'location' ) );
        echo JCckDev::renderForm( 'core_dev_textarea', @$options2['add_custom'], $config, array( 'label'=>'Custom Variables', 'defaultvalue'=>'', 'cols'=>92, 'rows'=>1, 'storage_field'=>'json[options2][add_custom]' ), array(), 'w100' );

        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_SELECT' ) );
        echo JCckDev::renderForm( 'core_bool3', $this->item->bool3, $config, array( 'label'=>'Mode', 'defaultvalue'=>'0', 'options'=>'None=-2||Modal Box=0' ) );
        echo JCckDev::renderForm( 'core_extended', @$locations[1], $config, array( 'label'=>_C4_TEXT, 'storage_field'=>'location2' ) );
        echo JCckDev::renderBlank();
        echo JCckDev::renderForm( 'core_dev_select', @$options2['select_task'], $config, array( 'label'=>'Config Search Task', 'defaultvalue'=>'search', 'selectlabel'=>'', 'options'=>'No=no||Yes=search', 'storage_field'=>'json[options2][select_task]' ) );
        echo JCckDev::renderForm( 'core_dev_textarea', @$options2['select_custom'], $config, array( 'label'=>'Custom Variables', 'defaultvalue'=>'', 'cols'=>92, 'rows'=>1, 'storage_field'=>'json[options2][select_custom]' ), array(), 'w100' );

        echo JCckDev::renderSpacer( JText::_( 'COM_CCK_BATCH' ) );
        echo JCckDev::renderForm( 'core_bool4', $this->item->bool4, $config, array( 'label'=>'Mode', 'defaultvalue'=>'0', 'options'=>'Disabled=0||Enabled=1' ) );
        echo JCckDev::renderBlank();

		echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#location').isDisabledWhen('bool2','-2');
    $('#location2').isDisabledWhen('bool3','-2');
    $("#adminForm").on("change", "#bool", function() {
        if ($(this).val()!="0") {
            $("#storage").val("none").prop("disabled",true);
        } else {
            $("#storage").prop("disabled",false);
        }
    });
    if ($("#bool").val()!="0") {
        $("#storage").val("none").prop("disabled",true);
    } else {
        $("#storage").prop("disabled",false);
    }
});
</script>