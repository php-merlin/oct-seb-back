<?php
defined( '_JEXEC' ) or die;
?>
<div class="dropdown-wrapper">
	<button type="button" data-toggle="dropdown" class="dropdown-toggle btn">
		<span class="o-hide-after@sm icon-dots"></span>
		<span class="o-hide-before@sm"><?php echo JText::_( 'COM_CCK_ACTIONS' ); ?></span>
	</button>
	<ul class="dropdown-menu flex-column-reverse">
		<?php echo $displayData['html']; ?>
	</ul>
</div>