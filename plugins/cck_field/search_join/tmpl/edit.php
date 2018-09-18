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
$options2	=	json_decode( $this->item->options2, true );
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_'.$this->item->type.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
        for ( $i = 0; $i < 10; $i++ ) {
	        echo '<li class="w100 cck-fl"><label>'.JText::_( 'COM_CCK_JOIN' ).' ('.( $i + 1 ).')'.'</label>'
	         .	 JCckDev::getForm( 'core_dev_select', @$options2['joins'][$i]['mode'], $config, array( 'defaultvalue'=>'LEFT', 'selectlabel'=>'', 'options'=>'Table=0||Query=1', 'storage_field'=>'json[options2][joins]['.$i.'][mode]', 'size'=>12, 'css'=>'mini valign' ) )
	         .	 JCckDev::getForm( 'core_dev_text', @$options2['joins'][$i]['aka'], $config, array( 'defaultvalue'=>'', 'storage_field'=>'json[options2][joins]['.$i.'][aka]', 'size'=>38, 'css'=>'mini input-xlarge', 'attributes'=>'placeholder="Optionally AKA: \'aka_table1\', \'aka_table2\', ..."' ) )
	         .	 '</li>'
	         .	 '<li class="w100"><label></label>'
			 .	 JCckDev::getForm( 'core_dev_select', @$options2['joins'][$i]['type'], $config, array( 'defaultvalue'=>'LEFT', 'selectlabel'=>'', 'options'=>'INNER=optgroup||INNER=INNER||OUTER=optgroup||LEFT=LEFT||RIGHT=RIGHT', 'storage_field'=>'json[options2][joins]['.$i.'][type]', 'size'=>12, 'css'=>'mini valign', 'attributes'=>'style="width:100px;"' ) )
			 .	 JCckDev::getForm( 'core_dev_text', @$options2['joins'][$i]['table'], $config, array( 'storage_field'=>'json[options2][joins]['.$i.'][table]', 'size'=>60, 'css'=>'left mr-3 text-center', 'maxlength'=>'1024', 'attributes'=>'style="max-width:600px;"' ) )
			 .	 JCckDev::getForm( 'core_dev_text', @$options2['joins'][$i]['column'], $config, array( 'storage_field'=>'json[options2][joins]['.$i.'][column]', 'size'=>12, 'css'=>'mini valign text-center' ) )
			 .	 '</li>'
			 .	 '<li class="w100"><label>&nbsp;&nbsp;&nbsp;&nbsp;'.JText::_( 'COM_CCK_ON' ).'...</label>'
			 .	 JCckDev::getForm( 'core_dev_text', @$options2['joins'][$i]['table2'], $config, array( 'storage_field'=>'json[options2][joins]['.$i.'][table2]','size'=>50, 'css'=>'right text-center', 'attributes'=>'style="max-width:324px; margin-left:106px;"' ) )	 
			 .	 JCckDev::getForm( 'core_dev_text', @$options2['joins'][$i]['column2'], $config, array( 'storage_field'=>'json[options2][joins]['.$i.'][column2]', 'size'=>12, 'css'=>'mini valign text-center' ) )
			 .	 JCckDev::getForm( 'core_dev_text', @$options2['joins'][$i]['and'], $config, array( 'storage_field'=>'json[options2][joins]['.$i.'][and]', 'size'=>12, 'css'=>'mini valign text-center', 'attributes'=>'placeholder="AND"' ) )
			 .	 '</li>';
        }
		
		echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>

<style type="text/css">
body.contentpane.component ul.adminformlist li.w100 input.left,
body.contentpane.component ul.adminformlist li.w100 input.right{max-width: 190px;}
div.seblod ul.adminformlist li.w100 input.left{margin-right: 3px;}
</style>
