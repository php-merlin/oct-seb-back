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

JCckDev::initScript( 'processing', $this->item );
?>
<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_SETTINGS' ) ); ?>
	<?php
	echo '<ul class="adminformlist adminformlist-2cols">';
	echo JCckDev::renderForm( 'core_dev_text', @$options['apps'], $config, array( 'label'=>'App Folder', 'defaultvalue'=>'', 'selectlabel'=>'', 'storage_field'=>'json[options][apps]' ) );
	echo '</ul>';
	?>
</div>