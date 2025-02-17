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
class plgCCK_FieldItem_X extends JCckPluginField
{
	protected static $type			=	'item_x';
	protected static $path;

	protected static $properties	=	array();
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Construct
	
	// onCCK_FieldConstruct
	public function onCCK_FieldConstruct( $type, &$data = array() )
	{
		if ( self::$type != $type ) {
			return;
		}
		if ( !isset( $data['location'] ) ) {
			$data['location']	=	'';
		}
		if ( isset( $data['location2'] ) && $data['location2'] != '' ) {
			$data['location']	.=	'||'.$data['location2'];
		}
		if ( isset( $data['extended2'] ) && $data['extended2'] != '' ) {
			$data['extended']	.=	'||'.$data['extended2'];
		}
		parent::g_onCCK_FieldConstruct( $data );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
	
	// onCCK_FieldPrepareContent
	public function onCCK_FieldPrepareContent( &$field, $value = '', &$config = array() )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		parent::g_onCCK_FieldPrepareContent( $field, $config );
		
		// Set
		if ( $field->bool ) {
			$field->value	=	'';
		} else {
			$field->value	=	$value;
		}
	}
	
	// onCCK_FieldPrepareForm
	public function onCCK_FieldPrepareForm( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		self::$path		=	parent::g_getPath( self::$type.'/' );
		if ( $field->bool ) {
			$field->label2	=	trim( @$field->label2 );	
		}
		parent::g_onCCK_FieldPrepareForm( $field, $config );
		
		// Init
		$id				=	$field->name;
		$name			=	$field->name;

		if ( isset( $inherit['caller'] ) && $inherit['caller'] ) {
			$referrer	=	$inherit['caller'].'.'.$config['client_form'];
		} else {
			$parent		=	( isset( $config['type_parent'] ) && $config['type_parent'] ) ? $config['type_parent'].'-' : '';
			$referrer	=	$parent.$config['type'];

			if ( isset( $config['client_form'] ) && $config['client_form'] ) {
				$referrer	.=	'.'.$config['client_form'];
			} else {
				$referrer	.=	'.search';
			}
		}
		
		if ( $field->bool && $field->label ) {
			$field->markup_class	.=	' o-input-top';
		}

		// Validate
		if ( $config['doValidation'] > 1 ) {
			plgCCK_Field_ValidationRequired::onCCK_Field_ValidationPrepareForm( $field, $id, $config );
		}
		
		// Prepare

		if ( $field->variation == 'hidden' ) {
			$html			=	'';
			$field->text	=	'';
			parent::g_getDisplayVariation( $field, $field->variation, $value, $field->text, $html, $id, $name, '<input', '', '', $config );
		} else {
			$app		=	JFactory::getApplication();
			$form		=	$field->location;
			$list		=	'';
			
			if ( strpos( $form, '||' ) !== false ) {
				$form	=	explode( '||', $form );
				$list	=	$form[1];
				$form	=	$form[0];
			}

			$identifier	=	'pk';
			$itemId		=	JFactory::getApplication()->input->getInt( 'Itemid' );
			$options2	=	JCckDev::fromJSON( $field->options2 );
			$tmpl		=	'raw';

			if ( !isset( $options2['add_custom'] ) ) {
				$options2['add_custom']		=	'';
			}
			$options2['add_custom']			=	JCckDevHelper::replaceLive( $options2['add_custom'] );
			$options2['add_custom']		=	( $options2['add_custom'] != '' ) ? '&'.$options2['add_custom'] : '';

			if ( !isset( $options2['select_custom'] ) ) {
				$options2['select_custom']	=	'';
			}
			$options2['select_custom']		=	JCckDevHelper::replaceLive( $options2['select_custom'] );
			$options2['select_custom']		=	( $options2['select_custom'] != '' ) ? '&'.$options2['select_custom'] : '';

			if ( isset( $options2['select_task'] ) && $options2['select_task'] == 'no' ) {
				$options2['select_custom']	.=	'&task=no';
			}
			if ( isset( $options2['identifier'] ) && $options2['identifier'] != '' ) {
				$identifier	=	$options2['identifier'];
			}
			if ( $app->isClient( 'administrator' ) ) {
				$layout	=	'default';
				$task	=	'form.saveAjax';
				$task2	=	'form.processAjax';
			} else {
				$layout	=	'edit';
				$task	=	'saveAjax';
				$task2	=	'processAjax';
			}

			$referrer_id	=	(int)$config['pk'];

			$context	=	'&context={"view":"form","referrer":"","referrer_id":"'.$referrer_id.'"}';
			$doc		=	JFactory::getDocument();
			$html		=	'';
			$link		=	'index.php?option=com_cck&view=form&layout='.$layout.'&type='.$form.'&tmpl='.$tmpl.$options2['add_custom'];
			$link		=	( $app->isClient( 'administrator' ) ) ? $link : JRoute::_( $link.'&Itemid='.$itemId );
			$link2		=	JCckDevHelper::getAbsoluteUrl( 'auto', 'view=list&search='.$list.'&tmpl='.$tmpl.'&referrer='.$referrer.'.'.$name.$options2['select_custom'] );

			if ( strpos( $link, '$cck-' ) !== false ) {
				$link 	=	str_replace( '&gt;', '>', $link );
				parent::g_addProcess( 'beforeRenderForm', self::$type, $config, array( 'name'=>$field->name, 'target'=>'link_add', 'link'=>$link, 'itemId'=>0 ), 5 );
			}
			if ( strpos( $link2, '$cck->' ) !== false ) {
				parent::g_addProcess( 'beforeRenderForm', self::$type, $config, array( 'name'=>$field->name, 'target'=>'link_select', 'link'=>$link2, 'itemId'=>$itemId ), 5 );
			}

			$extended	=	$field->extended;
				
			if ( strpos( $extended, '||' ) !== false ) {
				$extended	=	explode( '||', $extended );
				$extended	=	$extended[0];
			}

			$link2				=	( $app->isClient( 'administrator' ) ) ? $link2 : JRoute::_( $link2.'&Itemid='.$itemId );
			$link5				=	JCckDevHelper::getAbsoluteUrl( 'auto', 'format=raw&view=list&layout=default&search='.$extended ).$context;
			$link6				=	JCckDevHelper::getAbsoluteUrl( 'auto', 'format=raw&task='.$task );
			$link7				=	JCckDevHelper::getAbsoluteUrl( 'auto', 'format=raw&task='.$task2 );
			$toolbar_selector	=	'[class*=\"-toolbar\"]';

			static $loaded	=	0;

			if ( !$loaded ) {
				$js		=	'
							if("undefined"===typeof JCck.More){JCck.More={}};
							(function ($){
								JCck.More.ItemX = {
									active: "",
									instances: [],
									modal: JCck.Core.getModal({"backclose":false,"class":"modal-backend o-modal-stretch","title":"'.JText::_( 'COM_CCK_ADD' ).' / '.JText::_( 'COM_CCK_EDIT' ).'"}),
									modal_preview: JCck.Core.getModal({"backclose":false,"backdrop":false,"title":"'.JText::_( 'COM_CCK_PREVIEW' ).'"}),
									modal_form_id:"'.$config['formId'].'_'.$tmpl.'",
									token:"'.JSession::getFormToken().'=1",
									add: function(form) {
										var form = form || "";
										var link = JCck.More.ItemX.instances[JCck.More.ItemX.active].link_add;
										if (form) {
											var parts = link.split("?");
											link = link.substring(0,parts[0].lastIndexOf("/"))+"/"+form+"?"+parts[1];
										}
										JCck.More.ItemX.modal.loadUrl(link);
									},
									assign: function(pks,close) {
										var close = close || false;
										var infinite = -1;
										if (JCck.More.ItemX.instances[JCck.More.ItemX.active].behavior) {
											if ($("#"+JCck.More.ItemX.active+" table > tbody").children().length) {
												infinite = 1;
											} else if ($("#"+JCck.More.ItemX.active+" ul").children().length) {
												infinite = 1;
											} else if ($("#"+JCck.More.ItemX.active+" .is-x").length && $("#"+JCck.More.ItemX.active+" .is-x > .cck-loading-more").length) {
												if ($("#"+JCck.More.ItemX.active+" .is-x > .cck-loading-more").children().length) {
													infinite = 1;
												}
											}
										}
										$.ajax({
											cache: false,
											data: "format=raw&infinite="+infinite+"&pks="+pks,
											type: "GET",
											url: JCck.More.ItemX.instances[JCck.More.ItemX.active].link_list,
											beforeSend:function() {
												this.url = this.url.replace(\'"referrer":""\',\'"referrer":"\'+JCck.More.ItemX.instances[JCck.More.ItemX.active].referrer+\'.\'+JCck.More.ItemX.active+\'"\');
											},
											success: function(response) {
												JCck.More.ItemX.toggleRequired(false);
												if (JCck.More.ItemX.instances[JCck.More.ItemX.active].behavior) {
													if (infinite == -1) {
														if (response.indexOf("cck-loading-more") == -1) {
															$("#"+JCck.More.ItemX.active+" .cck-loading-more").html(response);
														} else {
															$("#"+JCck.More.ItemX.active+" .cck-loading-more").parent().html(response);
														}
													} else {
														$("#"+JCck.More.ItemX.active+" .cck-loading-more").append(response);
													}
													JCck.More.ItemX.toggleReorder();
												} else {
													$("#"+JCck.More.ItemX.active+" > '.$toolbar_selector.'").hide();
													$("#"+JCck.More.ItemX.active+" > '.$toolbar_selector.' + *").show();
													$("#"+JCck.More.ItemX.active+" .cck-loading-more").html(response);
												}
												if (JCck.More.ItemX.instances[JCck.More.ItemX.active].callback) {
													JCck.Core.executeFunctionByName(JCck.More.ItemX.instances[JCck.More.ItemX.active].callback, window);
												}
		    									$(".hasTooltip").tooltip({"html": true,"container": "body"});

												if (close !== false) {
													JCck.More.ItemX.search();
													JCck.More.ItemX.modal.hide();
													JCck.More.ItemX.modal.groups.ajax	=	[];
													$("#"+JCck.More.ItemX.active+" a[data-cck-modal]").each(function(i, e) {
														JCck.More.ItemX.modal.groups.ajax.push($(e));
													});
		    										JCck.More.ItemX.modal.init();
												}
											},
											error:function(){}
										});
									},
									assignX: function() {
										if (document.seblod_form_raw.boxchecked.value==0) {
											alert("'.addslashes( JText::_( 'JLIB_HTML_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST' ) ).'"); return;
										} else {
											var val = [];
											$("input:checkbox[name=\'cid[]\']:checked").each(function(i) {
												var v = $(this).val();
												if (!JCck.More.ItemX.check(v)) {
													val[i] = v;
												}
											});
											val = (val.length) ? val.join(",") : "";
											JCck.More.ItemX.assign(val,true);
										}
									},
									callback: function() {
										JCck.More.ItemX.dispatch();
									},
									check: function(id) {
										if ($("#"+id+"_"+JCck.More.ItemX.active).length) {
											return true;
										} else {
											return false;
										}
									},
									dispatch: function() {
										$(".hasTooltip").tooltip({"html": true,"container": "#modal-cck"}).on("hidden", function (e) {
										   e.stopPropagation();
										});
										/*
										$(".hasPopover").popover({"html": true,"trigger": "hover","container":"body"}).on("hidden", function (e) {
										   e.stopPropagation();
										});
										*/
										$("#"+JCck.More.ItemX.modal_form_id+" a[data-cck-modal]").CckModal();

										if ($("#"+JCck.More.ItemX.modal_form_id+" .cck-loading-more").length) {
											$("#"+JCck.More.ItemX.modal_form_id+" .cck-loading-more input:checkbox[name=\'cid[]\']").each(function(i) {
												var v = $(this).val();
												if (JCck.More.ItemX.check(v)) {
													$(this).parents("tr").find(".item_x-assign").hide();
												} else {
													$(this).parents("tr").find(".item_x-remove").hide();
												}
											});
										}
									},
									fill: function(key,value,close) {
										var close = close || false;

										$("#"+key).myVal(value); /* TODO: use query: target=... ?? JCck.More.ItemX.active */

										if (close !== false) {
											JCck.More.ItemX.modal.hide();
										}
									},
									process: function(id,tid) {
										$.ajax({
											cache: false,
											data: "cid[]="+id+"&tid="+tid,
											type: "POST",
											url: JCck.More.ItemX.instances[JCck.More.ItemX.active].link_process,
											beforeSend:function(){},
											success: function(response) {
												var resp = jQuery.parseJSON(response);
												if(typeof resp == "object") {
													if (resp.isNew && resp[JCck.More.ItemX.instances[JCck.More.ItemX.active].identifier]) {
														JCck.More.ItemX.assign(resp[JCck.More.ItemX.instances[JCck.More.ItemX.active].identifier],true);
													} else {
														JCck.More.ItemX.modal.hide();
													}
												} else {
													JCck.More.ItemX.modal.hide();
												}
											},
											error:function(){}
										});
									},
									remove: function(id,close) {
										var close = close || false;
										if (JCck.More.ItemX.instances[JCck.More.ItemX.active].behavior) {
											if ($("#"+id+"_"+JCck.More.ItemX.active).length) {
												var $el_p = $("#"+id+"_"+JCck.More.ItemX.active).parents(JCck.More.ItemX.instances[JCck.More.ItemX.active].html_tag);
												$el_p.find(".hasTooltip").tooltip("destroy");
												$el_p.remove();

												if($("#"+JCck.More.ItemX.active+" .cck-loading-more").length) {
													if($("#"+JCck.More.ItemX.active+" .cck-loading-more").html().length === 0) {
														JCck.More.ItemX.toggleRequired(true);
													}
												}
											}
										} else {
											$("#"+JCck.More.ItemX.active+" .cck-loading-more").find(".hasTooltip").tooltip("destroy");
											$("#"+JCck.More.ItemX.active+" .cck-loading-more").html("");
											JCck.More.ItemX.toggleRequired(true);
											$("#"+JCck.More.ItemX.active+" > '.$toolbar_selector.'").show();
											$("#"+JCck.More.ItemX.active+" > '.$toolbar_selector.' + *").hide();
										}

										if (JCck.More.ItemX.instances[JCck.More.ItemX.active].callback) {
											JCck.Core.executeFunctionByName(JCck.More.ItemX.instances[JCck.More.ItemX.active].callback, window);
										}

										JCck.More.ItemX.search();

										if (close !== false) {
											JCck.More.ItemX.modal.hide();
										} else {
											if (JCck.More.ItemX.active && $("#"+JCck.More.ItemX.active).length) {
												JCck.More.ItemX.active = "";
											}
										}
									},
									save: function() {
										if ($("#"+JCck.More.ItemX.modal_form_id).validationEngine("validate","JCck.More.ItemX.save") === true) {
											$("#"+JCck.More.ItemX.modal_form_id+" #task").remove();
											$("#"+JCck.More.ItemX.modal_form_id+" input[name=\'config[unique]\']").val("seblod_form_seb_field");
											
											var method = "formdata"; /* formdata || jquery */
											
											if (method == "formdata" && window.File && window.FileList && window.Blob && window.FileReader && window.FormData) {
												var $formElem = $("#"+JCck.More.ItemX.modal_form_id);
												var formData = new FormData($formElem[0]);
												
												var xhr = new XMLHttpRequest();
												xhr.open("POST", JCck.More.ItemX.instances[JCck.More.ItemX.active].link_save, true);
												xhr.onload = function(e) {
													var resp = JSON.parse(this.response);
													if(typeof resp == "object") {
														if (resp.isNew && resp[JCck.More.ItemX.instances[JCck.More.ItemX.active].identifier]) {
															JCck.More.ItemX.assign(resp[JCck.More.ItemX.instances[JCck.More.ItemX.active].identifier],true);
														} else {
															JCck.More.ItemX.modal.hide();
														}
													} else {
														JCck.More.ItemX.modal.hide();
													}
												};
												xhr.send(formData);
											} else {
												$.ajax({
													cache: false,
													data: $("#"+JCck.More.ItemX.modal_form_id).serialize(),
													type: "POST",
													url: JCck.More.ItemX.instances[JCck.More.ItemX.active].link_save,
													beforeSend:function(){},
													success: function(response) {
														var resp = jQuery.parseJSON(response);
														if(typeof resp == "object") {
															if (resp.isNew && resp[JCck.More.ItemX.instances[JCck.More.ItemX.active].identifier]) {
																JCck.More.ItemX.assign(resp[JCck.More.ItemX.instances[JCck.More.ItemX.active].identifier],true);
															} else {
																JCck.More.ItemX.modal.hide();
															}
														} else {
															JCck.More.ItemX.modal.hide();
														}
													},
													error:function(){}
												});
											}
										}
									},
									search: function() {
										if (JCck.More.ItemX.instances[JCck.More.ItemX.active].trigger) {
											JCck.Core.executeFunctionByName(JCck.More.ItemX.instances[JCck.More.ItemX.active].trigger, window, \'search\');
										}
									},
									select: function(target) {
										var target = target || "";
										var selection = "";
										if (!JCck.More.ItemX.instances[JCck.More.ItemX.active].behavior) {
											selection = $("#"+JCck.More.ItemX.active+" [name=\'"+JCck.More.ItemX.active+"[]\']").val();
											if (selection===undefined) {
												selection = "";
											}
											if (selection) {
												selection = "&pks="+selection;
											}
										}
										if (target) {
											selection += "&target="+target;
										}
										JCck.More.ItemX.modal.loadUrl(JCck.More.ItemX.instances[JCck.More.ItemX.active].link_select+selection);
									},
									set: function(name) {
										JCck.More.ItemX.active = name;
										return this;
									},
									setFromClick: function(el,always) {
										var always = (always !== undefined) ? always : true;
										if (always || !JCck.More.ItemX.active) {
											JCck.More.ItemX.set($(el).parents(".item_x").attr("id"));
										}
										return this;
									},
									setInstance: function(name, data) {
										JCck.More.ItemX.instances[name] = data;
										JCck.More.ItemX.instances[name].html_tag = "tr";

										if($("#"+name+" .cck-loading-more").length) {
											var tag = $("#"+name+" .cck-loading-more").prop("tagName");
											
											if (tag == "UL") {
												JCck.More.ItemX.instances[name].html_tag = "li";
											} else if (tag == "DIV") {
												JCck.More.ItemX.instances[name].html_tag = "article";
											}
										}

										if(JCck.More.ItemX.instances[name].behavior) {
											if($("#"+name+" .cck-loading-more").length) {
												if($("#"+name+" .cck-loading-more").html().length === 0) {
													JCck.More.ItemX.toggleRequired(true,name);
												}
											}
											setTimeout(function() {
												JCck.More.ItemX.toggleReorder();
											}, 500);
										} else {
											if($("#"+name+" .cck-loading-more").length) {
												if($("#"+name+" .cck-loading-more").html().length > 1) {
													$("#"+name+" > '.$toolbar_selector.'").hide();
													$("#"+name+" > '.$toolbar_selector.' + *").show();
												} else {
													JCck.More.ItemX.toggleRequired(true,name);
													$("#"+name+" > '.$toolbar_selector.' + *").hide();
												}
											}
										}
									},
									toggleReorder: function() {
										var sortableList = new $.JSortableList("#seblod_form table.table tbody","seblod_form","asc" , "index.php?option=com_cck&task=ajax&format=raw&"+Joomla.getOptions("csrf.token")+"=1","","1");
									},
									toggleRequired: function(state,name) {
										name = name || JCck.More.ItemX.active;
										if (JCck.More.ItemX.instances[name].required) {
											if (state) {
												$("#"+name+" > '.$toolbar_selector.' > button:last-child").addClass("validate[required]");
											} else {
												$("#"+name+" > '.$toolbar_selector.' > button:last-child").removeClass("validate[required]").validationEngine("hide");
											}
										}
									}
								};
								$(document).ready(function() {
									JCck.More.ItemX.modal.settings.callbacks.load = function() {
										JCck.More.ItemX.setFromClick(JCck.More.ItemX.modal.referrer,false);
									};
									JCck.More.ItemX.modal.settings.callbacks.loaded = function() {
										/* TODO: hide checkboxes */
										JCck.More.ItemX.dispatch();
									};
									JCck.More.ItemX.modal.settings.callbacks.hide = function() {
										JCck.More.ItemX.active = "";
									};
									JCck.More.ItemX.modal.settings.callbacks.hidden = function() {
										JCck.More.ItemX.modal.settings.backdrop = true;
										$(".modal-backdrop").fadeOut(300);
									};
									JCck.More.ItemX.modal_preview.settings.callbacks.hidden = function() {
										JCck.More.ItemX.set(JCck.More.ItemX.active);
										JCck.More.ItemX.modal.settings.backdrop = false;
										JCck.More.ItemX.select();
									};
								});
							})(jQuery);
							';
				$loaded	=	1;

				$doc->addStyleSheet( self::$path.'assets/css/style.css' );
				$doc->addScriptDeclaration( $js );
			}

			$callback	=	'';
			$trigger	=	'';

			if ( $config['client'] == 'search' && $field->variation == 'form_filter' ) {
				if ( isset( $config['submit'] ) ) {
					$trigger	=	$config['submit'];
				} else {
					$trigger	=	'JCck.Core.submit';
				}
			}

			$extended_opts	=	JCckDatabase::loadResult( 'SELECT options FROM #__cck_core_searchs WHERE name = "'.$extended.'"' );

			if ( $extended_opts ) {
				$extended_opts	=	json_decode( $extended_opts );

				if ( isset( $extended_opts->callback_pagination ) && $extended_opts->callback_pagination ) {
					$callback	=	$extended_opts->callback_pagination;
				}
			}

			$js 	=	'
						(function ($){
							$(document).ready(function() {
								var data = {
									"behavior":'.$field->bool.',
									"callback":"'.$callback.'",
									"identifier":"'.$identifier.'",
									"link_add":"'.htmlspecialchars_decode( $link ).'",
									"link_list":\''.$link5.'\',
									"link_process":\''.$link7.'\',
									"link_select":"'.htmlspecialchars_decode( $link2 ).'&referrer_id='.$referrer_id.'",
									"link_save":\''.$link6.'\',
									"referrer":\''.$referrer.'\',
									"required":'.( $field->required ? 1 : 0 ).',
									"trigger":\''.$trigger.'\'
								};
								JCck.More.ItemX.setInstance("'.$field->name.'", data);					
							});
						})(jQuery);
						';
			$doc->addScriptDeclaration( $js );
			
			self::$properties[$field->name]	=	array(
													'mode'=>( $field->bool ? true : false ),
													'required'=>( $field->required ? true : false ),
													'task_add'=>( $field->bool2 > -2 ? true : false ),
													'task_batch'=>( (int)$field->bool4 > 0 ? true : false ),
													'task_check'=>( (int)$field->bool3 == -1 ? true : false ),
													'task_select'=>( (int)$field->bool3 > -1 ? true : false ),
													'ui'=>( (int)$field->bool3 == -1 ? true : false )
												);

			// Check Permissions
			if ( self::$properties[$field->name]['task_add'] ) {
				$type_id	=	(int)JCckDatabase::loadResult( 'SELECT id FROM #__cck_core_types WHERE name = "'.$form.'"' );
				$canCreate	=	( $type_id ) ? JFactory::getUser()->authorise( 'core.create', 'com_cck.form.'.$type_id ) : false;
					
				if ( !$canCreate ) {
					self::$properties[$field->name]['task_add']	=	false;
				}
			}

			$buffer		=	self::_render( $field, $value, array(), $config, $referrer );
			$css		=	$field->css ? ' '.$field->css : '';
			$html		.=	$buffer['form'];
			$html		.=	$buffer['list'];
			$html		=	'<div id="'.$field->name.'" class="item_x'.$css.'">'.$html.'</div>';

			if ( $buffer['validation'] ) {
				$config['validation']	=	array_merge( $config['validation'], $buffer['validation'] );
			}

			if ( $field->bool ) {
				JHtml::_( 'jquery.ui', array( 'core', 'sortable' ) );
				JHtml::_( 'script', 'jui/sortablelist.js', false, true );
				JHtml::_( 'stylesheet', 'jui/sortablelist.css', false, true, false );
			}
		}

		// Set
		$field->form	=	$html;
		$field->value	=	'';
		
		// Return
		if ( $return === true ) {
			return $field;
		}
	}

	// onCCK_FieldPrepareResource
	public function onCCK_FieldPrepareResource( &$field, $value = '', &$config = array() )
	{
		if ( self::$type != $field->type ) {
			return;
		}

		if ( $config['resource_type'] ) {
			$context		=	array(
									'resource_relation'=>$config['resource'],
									'resource_relation_id'=>$config['resource_id'],
								);

			if ( $config['resource_identifier'] != '' ) {
				$context['resource_relation_id']	=	(string)((int)$config['pk']);
			}

			$output			=	JCckWebservice::output( $config['resource_relation'], $context );

			// Tweak Output
			if ( isset( $output['data']['code'] ) ) {
				$output		=	array();
			} else {
				$output		=	$output['data'];
			}

			$field->data	=	$output;
		}
	}
	
	// onCCK_FieldPrepareSearch
	public function onCCK_FieldPrepareSearch( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		
		// Init
		$bidirectional	=	false;
		$extended		=	$field->extended;
		$field->value	=	'';
		
		if ( strpos( $extended, '||' ) !== false ) {
			$extended	=	explode( '||', $extended );

			if ( $extended[1] ) {
				$bidirectional	=	true;
			}
		}

		// Prepare
		if ( $bidirectional ) {
			$app			=	JFactory::getApplication();
			$field->form	=	'';
			$id				=	$app->input->getInt( 'id' );

			if ( $id ) {
				$config['joins'][$field->stage][]	=	(object)array(
															'aka'=>'',
															'and'=>'',
															'column'=>'id',
															'column2'=>'id',
															'mode'=>'0',
															'table'=>'#__cck_store_join_'.$extended[1],
															'table2'=>'#__content',
															'type'=>'LEFT'
														);

				$bidirectional_pk	=	(int)JCckDatabase::loadResult( 'SELECT id FROM #__cck_store_join_'.$extended[1].' WHERE id2 = '.$id );

				$app->input->set( 'pks', $bidirectional_pk );
			}
		} else {
			if ( $field->variation == 'hidden' ) {
				parent::g_onCCK_FieldPrepareSearch( $field, $config );

				if ( $value != '' ) {
					$field->value	=	(int)$value;
				}
			} else {
				self::onCCK_FieldPrepareForm( $field, $value, $config, $inherit, $return );

				if ( $value != '' ) {
					$field->value	=	$value;
				}
			}
		}
		
		// Return
		if ( $return === true ) {
			return $field;
		}
	}
	
	// onCCK_FieldPrepareStore
	public function onCCK_FieldPrepareStore( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		
		// Init
		if ( count( $inherit ) ) {
			$name	=	( isset( $inherit['name'] ) && $inherit['name'] != '' ) ? $inherit['name'] : $field->name;
		} else {
			$name	=	$field->name;
		}

		if ( $field->bool ) {
			$value		=	'';
		
			parent::g_addProcess( 'afterStore', self::$type, $config, array( 'name'=>$name, 'bidirectional'=>'' ) );
		} else {
			if ( is_array( $value ) && isset( $value[0] ) ) {
				$value	=	$value[0];
			} elseif ( $value === null ) {
				$field->state	=	'';
				$value			=	'';
			}

			if ( $value ) {
				$extended	=	$field->extended;
				
				if ( strpos( $extended, '||' ) !== false ) {
					$extended	=	explode( '||', $extended );

					if ( $extended[1] ) {
						parent::g_addProcess( 'afterStore', self::$type, $config, array( 'name'=>$name, 'bidirectional'=>$extended[1] ) );
					}
				}
			}
			
			// Validate
			parent::g_onCCK_FieldPrepareStore_Validation( $field, $name, $value, $config );
		}
		
		// Set or Return
		if ( $return === true ) {
			return $value;
		}
		$field->value	=	$value;
		parent::g_onCCK_FieldPrepareStore( $field, $name, $value, $config );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Render
	
	// onCCK_FieldRenderContent
	public static function onCCK_FieldRenderContent( $field, &$config = array() )
	{
		return parent::g_onCCK_FieldRenderContent( $field );
	}
	
	// onCCK_FieldRenderForm
	public static function onCCK_FieldRenderForm( $field, &$config = array() )
	{
		return parent::g_onCCK_FieldRenderForm( $field );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Special Events
	
	// onCCK_FieldBeforeRenderForm
	public static function onCCK_FieldBeforeRenderForm( $process, &$fields, &$storages, &$config = array() )
	{
		$link		=	$process['link'];
		$name		=	$process['name'];
		$matches	=	'';
		$search		=	'#\$cck\->(get|retrieve)([a-zA-Z0-9_]*)\( ?\'([a-zA-Z0-9_,\[\]]*)\' ?\)(;)?#';

		preg_match_all( $search, $link, $matches );

		if ( count( $matches[2] ) ) {
			foreach ( $matches[2] as $k=>$v ) {
				$fieldname		=	$matches[3][$k];
				$method			=	$matches[1][$k];
				$target			=	strtolower( $v );
				$value			=	'';

				if ( strpos( $fieldname, ',' ) !== false ) {
					$fieldname	=	explode( ',', $fieldname );
					if ( count( $fieldname ) == 3 ) {
						if ( $fields[$fieldname[0]]->value[$fieldname[1]][$fieldname[2]] ) {
							$value	=	$fields[$fieldname[0]]->value[$fieldname[1]][$fieldname[2]]->$target;
						}
					} else {
						if ( $fields[$fieldname[0]]->value[$fieldname[1]] ) {
							$value	=	$fields[$fieldname[0]]->value[$fieldname[1]]->$target;
						}
					}
				} else {
					if ( !( $method == 'retrieve' && !$fields[$fieldname]->state ) ) {
						$value	=	$fields[$fieldname]->$target;
					}
				}
				$link		=	str_replace( $matches[0][$k], $value, $link );
			}

			if ( $process['itemId'] ) {
				$link		=	( JFactory::getApplication()->isAdmin() ) ? $link : JRoute::_( $link.'&Itemid='.$process['itemId'] );
			}
			
			$js		=	'
						(function ($){
							$(document).ready(function() {
								JCck.More.ItemX.instances["'.$name.'"].'.$process['target'].' = "'.htmlspecialchars_decode( $link ).'";
						    });
						})(jQuery);
						';
			JFactory::getDocument()->addScriptDeclaration( $js );
		}
	}
	
	// onCCK_FieldBeforeStore
	public static function onCCK_FieldBeforeStore( $process, &$fields, &$storages, &$config = array() )
	{
	}
	
	// onCCK_FieldAfterStore
	public static function onCCK_FieldAfterStore( $process, &$fields, &$storages, &$config = array() )
	{
		$name		=	$process['name'];

		if ( !$fields[$name]->bool ) {
			if ( $process['bidirectional'] && $fields[$name]->value ) {
				$pk			=	(int)$config['pk'];
				$table_name	=	'#__cck_store_join_'.$process['bidirectional'];

				if ( !(int)JCckDatabase::loadResult( 'SELECT COUNT(id) FROM '.$table_name.' WHERE id = '.(int)$fields[$name]->value.' AND id2 = '.$pk ) ) {
					JCckDatabase::execute( 'DELETE a.* FROM '.$table_name.' AS a WHERE a.id2 = '.$pk );

					$join		=	JCckTableBatch::getInstance( $table_name );
					
					$join->load( 'id = '.$fields[$name]->value, 'id2' );
					$join->bindArray( array( (int)$config['pk']=>(object)array(
																			'id2'=>(string)$pk,
																			'ordering'=>(string)$join->count() ) ) );
					$join->check( array(
									'id'=>(string)$fields[$name]->value
								  ) );
					$join->store();
				}
			}
		} else {
			/*
			$keys		=	array(
								'admin'=>array(),
								'site'=>array(),
								'intro'=>array(),
								'content'=>array()
							);
			*/
			$keys		=	array();
			$hasKey		=	( count( $keys ) ) ? true : false;
			$pks		=	array();
			$table_name	=	'#__cck_store_join_'.$process['name'];
			$tables		=	array();

			if ( isset( $config['post'][$name] )
			  && is_array( $config['post'][$name] ) && count( $config['post'][$name] ) ) {
			  	$i		=	0;
			  	$pks	=	$config['post'][$name];

				foreach ( $config['post'][$name] as $field_id ) {
					if ( isset( $config['post'][$field_id] ) ) {
					  	if ( $hasKey && is_array( $config['post'][$field_id] ) && count( $config['post'][$field_id] ) ) {
							foreach ( $config['post'][$field_id] as $k=>$v ) {
								if ( isset( $keys[$k] ) ) {
									$keys[$k][$field_id]				=	$v;
									$keys[$k][$field_id]['id2']			=	$field_id;
									$keys[$k][$field_id]['ordering']	=	$i;
									$i++;
								}
							}
						} else {
							foreach ( $config['post'][$field_id] as $k=>$v ) {
								if ( strpos( $k, '#__' ) !== false ) {
									if ( !isset( $tables[$k] ) ) {
										$tables[$k]	=	array();
									}
									if ( !isset( $tables[$k][$field_id] ) ) {
										$tables[$k][$field_id]	=	$v;
									}
								}
								if ( !isset( $keys[$field_id] ) ) {
									$keys[$field_id]				=	array();
									$keys[$field_id]['id2']			=	$field_id;
									$keys[$field_id]['ordering']	=	$i;
									$i++;
								}
								$keys[$field_id][$k]			=	$v;
							}
						}					
					} else {
						$keys[$field_id]				=	array();
						$keys[$field_id]['id2']			=	$field_id;
						$keys[$field_id]['ordering']	=	$i;
						$i++;
					}
				}
			}

			// Core
			$clause		=	'id = '.$config['pk'];

			if ( count( $keys ) ) {
				if ( $hasKey ) {
					foreach ( $keys as $key=>$v ) {
						$clause2	=	$clause.' AND key = "'.$key.'"';
						$join		=	JCckTableBatch::getInstance( $table_name );
						$join->load( $clause2, 'fieldid' );
						$join->mergeArray( $v );
						$join->delete( $clause2 );
						$join->sort( $pks );
						$join->check( array(
										'key'=>$key,
										'id'=>$config['pk']
									  ) );
						$join->store();
					}
				} else {
					$join		=	JCckTableBatch::getInstance( $table_name );

					if ( $fields[$name]->bool == 2 ) {
						JCckDatabase::execute( 'DELETE a.* FROM '.$table_name.' AS a WHERE a.id2 IN ('.implode( ',', array_keys( $keys ) ).')' );
					}

					$join->load( $clause, 'id2' );
					$join->mergeArray( $keys );
					$join->delete( $clause );
					$join->sort( $pks );
					$join->check( array(
									'id'=>$config['pk']
								  ) );
					$join->store();
				}
			} else {
				$join	=	JCckTableBatch::getInstance( $table_name );
				$join->delete( $clause );
			}

			// More
			if ( count( $tables ) ) {
				foreach ( $tables as $table_name=>$items ) {
					$table	=	JCckTable::getInstance( $table_name );
					
					foreach ( $items as $k=>$v ) {
						$table->load( $k );
						$table->bind( $v );
						$table->store();
					}
				}
			}
		}
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Stuff & Script

	// getFieldProperty
	public static function getFieldProperty( $referrer, $property, $default = '' )
	{
		if ( !isset( self::$properties[$referrer] ) ) {
			if ( strpos( $referrer, '.' ) !== false ) {
				$parts	=	explode( '.', $referrer );
			} else {
				$parts	=	array( 0=>'', 1=>'', 2=>$referrer );
			}
			
			if ( $parts[1] == 'search' ) {
				$type	=	'search';
			} else {
				$type	=	'type';
			}

			$query	=	'SELECT DISTINCT a.name, a.bool, a.bool2, a.bool3, a.bool4, a.location';
			
			if ( $parts[0] ) {
				$query	.=	', b.required, b.variation';
			}

			$query	.=	' FROM #__cck_core_fields AS a';

			if ( $parts[0] ) {
				$query	.= 	' LEFT JOIN #__cck_core_'.$type.'_field AS b ON b.fieldid = a.id'
						. 	' LEFT JOIN #__cck_core_'.$type.'s AS c ON c.id = b.'.$type.'id';
			}

			$query	.=	' WHERE a.name = "'.$parts[2].'"';

			if ( $parts[0] ) {
				if ( strpos( $parts[0], '-' ) !== false ) {
					$types	=	explode( '-', $parts[0] );
					$query	.=	' AND (c.name="'.$types[0].'" OR c.name="'.$types[1].'") AND b.client = "'.$parts[1].'"';
				} else {
					$query	.=	' AND c.name="'.$parts[0].'" AND b.client = "'.$parts[1].'"';
				}
			}

			$field	=	JCckDatabaseCache::loadObject( $query );

			if ( !is_object( $field ) ) {
				return $default;
			}

			self::$properties[$referrer]	=	array(
													'mode'=>( $field->bool ? true : false ),
													'required'=>( $field->required ? true : false ),
													'task_add'=>( $field->bool2 > -2 ? true : false ),
													'task_batch'=>( (int)$field->bool4 > 0 ? true : false ),
													'task_check'=>( (int)$field->bool3 == -1 ? true : false ),
													'task_search'=>false,
													'task_select'=>( (int)$field->bool3 > -1 ? true : false ),
													'ui'=>( (int)$field->bool3 == -1 ? true : false ),
													'variation'=>( $field->variation ? $field->variation : 'form' )
												);

			if ( $type == 'search' ) {
				self::$properties[$referrer]['task_add']	=	false;
				self::$properties[$referrer]['task_search']	=	true;
				self::$properties[$referrer]['task_select']	=	false;
			}

			// Check Permissions
			if ( self::$properties[$referrer]['task_add'] ) {
				$form		=	$field->location;
				
				if ( strpos( $form, '||' ) !== false ) {
					$form	=	explode( '||', $form );
					$form	=	$form[0];
				}

				$type_id	=	(int)JCckDatabaseCache::loadResult( 'SELECT id FROM #__cck_core_types WHERE name = "'.$form.'"' );
				$canCreate	=	( $type_id ) ? JFactory::getUser()->authorise( 'core.create', 'com_cck.form.'.$type_id ) : false;
					
				if ( !$canCreate ) {
					self::$properties[$referrer]['task_add']	=	false;
				}
			}
		}

		if ( isset( self::$properties[$referrer][$property] ) ) {
			return self::$properties[$referrer][$property];
		}

		return $default;
	}

	// _render
	protected static function _render( $field, $value, $lives, $config, $referrer )
	{
		/*
		$main_config				=	$config;
		$main_field					=	$field;
		*/
		$app			=	JFactory::getApplication();
		$class_sfx		=	'';
		$uniqId			=	'_f'.$field->id;
		$formId			=	'seblod_form'; /* 'seblod_list'.$uniqId; */
		$formValidation	=	'';
		$option			=	$app->input->get( 'option', '' );
		$view			=	'';

		$extended	=	$field->extended;
				
		if ( strpos( $extended, '||' ) !== false ) {
			$extended	=	explode( '||', $extended );
			$extended	=	$extended[0];
		}

		$preconfig		=	array(
								'action'=>'',
								'auto_redirect'=>0,
								'client'=>'search',
								'formId'=>$formId,
								'idx'=>$field->id,
								'itemId'=>$app->input->getInt( 'Itemid', 0 ),
								'limitend'=>25,
								'limit2'=>0,
								'ordering'=>'',
								'ordering2'=>'',
								'search'=>$extended,
								'show_form'=>1,
								'submit'=>'JCck.Core.submit'.$uniqId,
								'task'=>'search',
							);

		if ( $field->bool3 == -1 ) {
			$preconfig['search2']	=	$extended.'_checkbox_list';
		}

		$offset			=	0;
		$limitstart		=	-1;
		$live			=	'';
		$order_by		=	'';

		if ( !$field->bool ) {
			if ( $value != '' ) {
				$app->input->set( 'pks', $value );
			}
		}

		$app->input->set( 'cck_item_x_referrer', $referrer.'.'.$field->name );

		// -- TODO#SEBLOD:
		$pagination		=	8;
		// -- TODO#SEBLOD:
		
		$raw_rendering	=	1;
		$variation		=	'';
		
		// Prepare
		jimport( 'cck.base.list.list' );
		include JPATH_SITE.'/libraries/cck/base/list/list_inc.php';
		
		$callback_pagination	=	'';
		$class_pagination		=	'pagination';
		$pages_total			=	1;
		$show_pagination		=	8;
		$show_more				=	0;

		$filter_ajax	=	( isset( $hasAjax ) && $hasAjax ) ? true : false;
		$load_ajax		=	( $filter_ajax || ( $pages_total > 1 && ( $show_pagination == 2 || $show_pagination == 8 ) ) ) ? true : false;

		ob_start();
		include __DIR__.'/tmpl/render.php';
		$buffer	=	array(
						'form'=>$form,
						'list'=>ob_get_clean(),
						'validation'=>$formValidation
					);
		
		if ( !$field->bool ) {
			$app->input->set( 'pks', null );
		}
		$app->input->set( 'cck_item_x_referrer', null );

		/*
		$config	=	$main_config;
		$field	=	$main_field;
		*/

		return $buffer;
	}
}
?>