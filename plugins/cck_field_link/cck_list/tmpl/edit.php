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

JCckDev::initScript( 'link', $this->item );
JCck::loadModalBox();

require_once JPATH_COMPONENT.'/helpers/helper_admin.php';
$lives	=	Helper_Admin::getPluginOptions( 'field_live', 'cck_', false, false, true );
$lives	=	array_merge( array( JHtml::_( 'select.option', '', JText::_( 'COM_CCK_SELECT_SL' ) ) ), Helper_Admin::getPluginOptions( 'field_live', 'cck_', false, false, true ) );
$html	=	JHtml::_( 'select.genericlist', $lives, 'live', 'class="input select"', 'value', 'text', '', 'live' );

$hide	=	$this->item->alt ? 'hide' : '';
if ( $this->item->alt ) {
	$hide		=	'hide';
	$required	=	'';
} else {
	$hide		=	'';
	$required	=	'required';
}
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_LINK_'.$this->item->name.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
		echo JCckDev::renderForm( 'core_list', '', $config, array(), array(), $hide );
		echo JCckDev::renderForm( 'core_menuitem', '', $config, array( 'options'=>'Use Live=-4', 'required'=>$required ) );
		echo JCckDev::renderBlank( '<input type="hidden" id="blank_li" value="" />' );
		echo '<li><label></label>'.JCckDev::getForm( 'core_dev_text', '', $config, array( 'label'=>'', 'defaultvalue'=>'', 'css'=>'input-small', 'storage_field'=>'values' ) ).$html.'<span class="c_link" id="live_button" name="live_button">+</span></li>';
		echo JCckDev::renderForm( 'core_dev_select', '', $config, array( 'defaultvalue'=>0, 'label'=>'Field', 'options'=>'None=-1||Field=optgroup||Inherited=0||Custom=1',
																		 'selectlabel'=>'', 'storage_field'=>'search_field' ), array(), $hide );
		echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'Field name', 'required'=>'required', 'storage_field'=>'search_fieldname' ), array(), $hide );
		
		echo JCckDev::renderSpacer( JText::_( 'COM_CCK_CONSTRUCTION' ) . '<span class="mini">('.JText::_( 'COM_CCK_GENERIC' ).')</span>' );
		echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'Class', 'size'=>24, 'storage_field'=>'class' ) );
		echo JCckDev::renderForm( 'core_options_target', '', $config, array( 'defaultvalue'=>'', 'selectlabel'=>'Inherited', 'options'=>'Target Blank=_blank||Target Self=_self||Target Parent=_parent||Target Top=_top||Advanced=optgroup||Modal Box=modal', 'storage_field'=>'target' ) );
		echo JCckDev::renderForm( 'core_dev_textarea', '', $config, array( 'label'=>'Parameters', 'cols'=>80, 'rows'=>1, 'storage_field'=>'target_params' ), array(), 'w100' );
		echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'Rel', 'size'=>32, 'storage_field'=>'rel' ) );
		echo '<li><label>'.JText::_( 'COM_CCK_TITLE' ).'</label>'
			. JCckDev::getForm( 'core_dev_select', '', $config, array( 'selectlabel'=>'None', 'options'=>'Custom Text=2||Translated Text=3', 'storage_field'=>'title' ) )
			. JCckDev::getForm( 'core_dev_text', '', $config, array( 'label'=>'Title', 'size'=>16, 'css'=>'input-medium', 'storage_field'=>'title_custom' ) )
			. '</li>';
		echo JCckDev::renderBlank();
		echo JCckDev::renderForm( 'core_tmpl', '', $config );
		echo JCckDev::renderForm( 'core_dev_textarea', '', $config, array( 'label'=>'Custom variables', 'cols'=>92, 'rows'=>1, 'storage_field'=>'custom' ), array(), 'w100' );
		echo JCckDev::renderForm( 'core_dev_select', '', $config, array( 'label'=>'Behavior', 'selectlabel'=>'', 'defaultvalue'=>'1', 'options'=>'Apply=1||Prepare=0', 'storage_field'=>'state' ) );
		echo JCckDev::renderBlank();
        ?>
    </ul>
</div>

<?php
JCckDev::addField( 'live', $config );
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#search_fieldname').isVisibleWhen('search_field','1');
	$('#target_params').isVisibleWhen('target','modal');
	$('#title_custom').isVisibleWhen('title','2,3',false);
	$("#values").hide();

	if ($("#live").val()) {
		$("#live_button").show();
	} else {
		$("#live_button").hide();
	}
	$("div#layout").on("change", "#live", function() {
		$("#values").val("");
		if ($(this).val()) {
			$("#live_button").show();
		} else {
			$("#live_button").hide();
		}
	});
	$("div#layout").on("click", "span.c_link", function() {
		var type = $("#live").val();
		if (type) {
			var url = "index.php?option=com_cck&task=box.add&tmpl=component&file=plugins/cck_field_live/"+type+"/tmpl/edit.php&id=values&name="+type+"&validation=1";
			$.colorbox({href:url, iframe:true, innerWidth:930, innerHeight:550, overlayClose:false, fixed:true, onLoad: function(){ $('#cboxClose').remove();}});
		}
	});
});
</script>