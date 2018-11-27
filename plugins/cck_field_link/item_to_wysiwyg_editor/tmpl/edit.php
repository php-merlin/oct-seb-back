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

JCckDev::initScript( 'link', $this->item );
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_LINK_'.$this->item->name.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
		echo JCckDev::renderForm( 'core_dev_select', '', $config, array( 'defaultvalue'=>'link', 'label'=>'Type', 'options'=>'Link On Selection=link||Insert Content=content', 'selectlabel'=>'', 'storage_field'=>'type' ) );
		echo JCckDev::renderBlank();
		echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'Field Link', 'size'=>24, 'required'=>'required', 'storage_field'=>'field_link' ) );
		echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'Field Text', 'size'=>24, 'storage_field'=>'field_text' ) );
        ?>
    </ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#field_link, #field_text').isVisibleWhen('type','link');
});
</script>