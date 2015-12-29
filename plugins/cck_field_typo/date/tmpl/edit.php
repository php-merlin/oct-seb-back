<?php
/**
* @version 			SEBLOD 3.x Core
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				http://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2013 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

JCckDev::initScript( 'typo', $this->item );

$formats	=	'Presets=optgroup||Date Format 01=Y-m-d||Date Format 02=d m y||Date Format 03=d m Y||Date Format 04=m d y||Date Format 05=m d Y||Date Format 06=m/Y||Date Format 07=M Y||Date Format 08=F Y||Date Format 09=F d, Y||Date Format 10=d F Y||Date Format 11=l, F d, Y||Date Format 12=l, d F Y';
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_TYPO_'.$this->item->name.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
		echo JCckDev::renderForm( 'core_dev_select', '', $config, array( 'label'=>'Format', 'selectlabel'=>'', 'defaultvalue'=>'', 'storage_field'=>'format',
								  'options'=>'Free=-1||Time Ago=-2||'.$formats ) );
		echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'Free Format', 'storage_field'=>'format_custom' ) );

		echo JCckDev::renderForm( 'core_dev_bool', '', $config, array( 'label'=>'Alternative', 'selectlabel'=>'', 'defaultvalue'=>'0', 'options'=>'No=0||Yes after n Days=optgroup||1=1||2=2||15=15||16=16||30=30', 'storage_field'=>'alt_format' ) );
		echo JCckDev::renderForm( 'core_dev_select', '', $config, array( 'label'=>'Format', 'selectlabel'=>'', 'defaultvalue'=>'', 'storage_field'=>'format2',
								  'options'=>$formats ) );
		echo JCckDev::renderBlank( '<input type="hidden" id="blank_li" value="" />' );
		echo JCckDev::renderForm( 'core_dev_bool', '', $config, array( 'label'=>'Unit', 'selectlabel'=>'', 'defaultvalue'=>'0', 'options'=>'Day=0||Hours=1', 'storage_field'=>'unit' ) );
        ?>
    </ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('ul li:first label, ul li:nth-child(4) label').css('width','115px');
	$('#format_custom').isVisibleWhen('format','-1');
	$('#alt_format').isVisibleWhen('format','-2');
	$('#format2').isVisibleWhen('alt_format','1,2,15,16,30');
	$('#blank_li').isVisibleWhen('alt_format','0');
});
</script>