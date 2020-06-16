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

JCckDev::initScript( 'restriction', $this->item );
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_RESTRICTION_'.$this->item->name.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
		echo JCckDev::renderBlank();
		echo JCckDev::renderForm( 'core_bool', '', $config, array( 'label'=>'Invert', 'defaultvalue'=>'0', 'options'=>'Yes=1||No=0', 'storage_field'=>'do' ) );
		echo '<li class="w100"><label>'.JText::_( 'COM_CCK_VARIABLE_VALUES' ).'</label>'
		 .	 JCckDev::getForm( 'core_dev_select', '', $config, array( 'label'=>'', 'selectlabel'=>'', 'defaultvalue'=>'isHigherOnly', 'options'=>'MATCH_NUMERIC_HIGHER_ONLY=isHigherOnly', 'storage_field'=>'match' ) )
		 .	 JCckDev::getForm( 'core_dev_text', '', $config, array( 'label'=>'', 'defaultvalue'=>'0', 'css'=>'input-small', 'storage_field'=>'values' ) )
		 .	 '</li>';
        ?>
    </ul>
</div>
