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

// Plugin
class plgButtonCCK extends JPlugin
{
	protected $autoloadLanguage = true;
	
	// onDisplay
	public function onDisplay( $name )
	{
		$app		=	JFactory::getApplication();
		$buttons	=	(array)$this->params->get( 'buttons' );
		$doc		=	JFactory::getDocument();
		$i			=	0;
		$itemId		=	$app->input->getInt( 'Itemid' );
		$toolbar	=	array();

		// Prepare
		$link		=	JCckDevHelper::getAbsoluteUrl( 'auto', 'view=list&tmpl=raw' );
		$link		=	( $app->isClient( 'administrator' ) ) ? $link : JRoute::_( $link.'&Itemid='.$itemId );

		foreach ( $buttons as $button ) {
			if ( !( (int)$button->location == 0 || ( (int)$button->location == 1 && in_array( $name, $button->fields ) ) ) ) {
				continue;
			}

			$toolbar[$i]			=	new JObject;
			$toolbar[$i]->class		=	'btn';
			$toolbar[$i]->link		=	'#';
			$toolbar[$i]->modal		=	false;
			$toolbar[$i]->name		=	$button->icon;
			$toolbar[$i]->onclick	=	'javascript:JCck.More.ButtonXtd.select(\''.$button->list.'\',\''.$name.'\');';
			$toolbar[$i]->options	=	'';
			$toolbar[$i]->text		=	$button->text;

			$i++;
		}

		static $loaded	=	0;

		if ( !$loaded ) {
			$js		=	'
						if("undefined"===typeof JCck.More){JCck.More={}};
						(function ($){
							JCck.More.ButtonXtd = {
								link_select:"'.htmlspecialchars_decode( $link ).'",
								modal: JCck.Core.getModal({"backclose":false,"class":"modal-picker","title":"'.JText::_( 'COM_CCK_ADD' ).' / '.JText::_( 'COM_CCK_EDIT' ).'"}),
								token:"'.JSession::getFormToken().'=1",
								insertText: function(editor,link,text) {
									var selection = window.parent.Joomla.editors.instances[editor].instance.selection.getContent();
									if (selection == "") {
										if (text != "" ) {
											selection = text;
										} else {
											alert("'.JText::_( 'PLG_EDITORS-XTD_CCK_PLEASE_FIRST_MAKE_A_SELECTION_FROM_THE_EDITOR' ).'");
											return false;
										}
									}

									var replace = "<a href=\""+link+"\">"+selection+"</a>";
									if (window.parent.Joomla && window.parent.Joomla.editors && window.parent.Joomla.editors.instances && window.parent.Joomla.editors.instances.hasOwnProperty(editor)) {
										window.parent.Joomla.editors.instances[editor].replaceSelection(replace);
									} else {
										window.parent.jInsertEditorText(replace, editor);
									}

									JCck.More.ButtonXtd.modal.hide();
								},
								select: function(list,editor) {
									JCck.More.ButtonXtd.modal.loadUrl(JCck.More.ButtonXtd.link_select+"&search="+list+"&editor="+editor);
								}
							}
						})(jQuery);
						';
			$loaded	=	1;

			$doc->addScriptDeclaration( $js );
		}

		return $toolbar;
	}
}
?>