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

JCckDev::initScript( 'field', $this->item, array( 'hasOptions'=>true,
												  'customAttr'=>array( 'direction', 'prepend', 'multilanguage' ), 'customAttrLabel'=>JText::_( 'COM_CCK_DIRECTION_ASC_DESC' ),
												  'fieldPicker'=>true ) );
JCckDev::forceStorage();
$options	=	JCckDev::fromSTRING( $this->item->options );
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_'.$this->item->type.'_DESC' ) ); ?>
    <ul class="adminformlist adminformlist-2cols">
        <?php
        echo JCckDev::renderForm( 'core_label', $this->item->label, $config );
        echo JCckDev::renderForm( 'core_extended', $this->item->extended, $config, array( 'label'=>'Field Optional', 'required'=>'' ) );
		echo JCckDev::renderForm( 'core_options', $options, $config, array( 'label'=>'Fields', 'rows'=>1 ), array( 'after'=>$this->item->init['fieldPicker'] ) );
		echo JCckDev::renderForm( 'core_bool', $this->item->bool, $config, array( 'label'=>'Mode', 'defaultvalue'=>'1', 'options'=>'Numeric=0||Text=1' ) );
		
		echo JCckDev::renderSpacer( JText::_( 'COM_CCK_STORAGE' ), JText::_( 'COM_CCK_STORAGE_DESC' ) );
		echo JCckDev::getForm( 'core_storage', $this->item->storage, $config );
        ?>
    </ul>
</div>