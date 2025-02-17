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

JCckDev::forceStorage();
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_'.$this->item->type.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
        echo JCckDev::renderForm( 'core_label', $this->item->label, $config );
        echo JCckDev::renderForm( 'core_extended', $this->item->extended, $config, array( 'required'=>'' ) );
        echo '<li><label>'.JText::_( 'COM_CCK_BEHAVIOR' ).'<span class="star"> *</span></label>'
         .   JCckDev::getForm( 'core_pane_behavior', $this->item->bool, $config, array( 'required'=>'required' ) )
         .   JCckDev::getForm( 'core_defaultvalue', $this->item->defaultvalue, $config, array( 'size'=>3, 'attributes'=>'style="text-align:center;"' ) )
         .   '</li>';
        echo JCckDev::renderForm( 'core_dev_text', $this->item->location, $config, array( 'label'=>'GROUP_IDENTIFIER', 'storage_field'=>'location' ) );
        echo JCckDev::renderForm( 'core_dev_bool', $this->item->bool2, $config, array( 'label'=>'URL', 'defaultvalue'=>'0', 'options'=>'None=0||Set Active Pane=1||Set Active Pane and URL Hash=2', 'storage_field'=>'bool2' ) );
        echo JCckDev::renderForm( 'core_dev_bool', $this->item->bool3, $config, array( 'label'=>'ITEM_IDENTIFIER', 'defaultvalue'=>'0', 'options'=>'Field Name=0||Label=1', 'storage_field'=>'bool3' ) );
        echo JCckDev::renderForm( 'core_dev_bool', $this->item->bool4, $config, array( 'label'=>'Position', 'defaultvalue'=>'0', 'options'=>'Top=0||Left=1', 'storage_field'=>'bool4' ) );
		
		echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#defaultvalue').isVisibleWhen('bool','0',false);
    $('#bool2,#bool3,#bool4').isVisibleWhen('bool','0');
});
</script>