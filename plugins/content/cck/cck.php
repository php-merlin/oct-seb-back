<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: cck.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// Plugin
class plgContentCCK extends JPlugin
{
	protected $cache	=	false;
	protected $legacy	=	0;
	protected $loaded	=	array();

	// __construct
	public function __construct( &$subject, $config )
	{
		parent::__construct( $subject, $config );

		$this->legacy	=	(int)JCck::getConfig_Param( 'core_legacy', '2012' );
	}
	
	// onContentAfterSave
	public function onContentAfterSave( $context, $article, $isNew )
	{
		if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
			$event	=	'onContentAfterSave';

			$this->_process( array( 'event', 'context', 'article', 'isNew' ), $event, $context, $article, $isNew );
		}
	}

	// onContentBeforeSave
	public function onContentBeforeSave( $context, $article, $isNew )
	{
		if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
			$event	=	'onContentBeforeSave';

			$this->_process( array( 'event', 'context', 'article', 'isNew' ), $event, $context, $article, $isNew );
		}
	}

	// onCckConstructionAfterDelete
	public function onCckConstructionAfterDelete( $context, $item )
	{
		if ( empty( $context ) ) {
			return false;
		}

		$db		=	JFactory::getDbo();
		$query	=	$db->getQuery( true )->select( 'name AS object' )
										 ->from( '#__cck_core_objects' )
										 ->where( 'context = '. $db->quote( $context ) );

		$db->setQuery( $query );
		$object	=	$db->loadResult();
		
		if ( ! $object ) {
			return true;
		}
		
		$table_key	=	$item->getKeyName();
		$table_name	=	$item->getTableName();
		$pk			= 	$item->$table_key;
		$base 		= 	str_replace( '#__', '', $table_name );
		
		$parent		=	'';
		$pkb		=	0;
		$type		=	'';

		// Core
		$idx	=	array( 'pk'=>$pk, 'storage_location'=>$object );
		$table	=	JCckTable::getInstance( '#__cck_core' );

		if ( $table->load( $idx ) ) {
			$type	=	$table->cck;
		}

		if ( $table->pk > 0 ) {
			// -- Leave nothing behind
			if ( $type != '' ) {
				require_once JPATH_LIBRARIES.'/cck/base/form/form.php';

				JPluginHelper::importPlugin( 'cck_field' );
				JPluginHelper::importPlugin( 'cck_storage' );
				JPluginHelper::importPlugin( 'cck_storage_location' );

				$config		=	array(
									'pk'=>$table->pk,
									'storages'=>array(),
									'type'=>$table->cck
								);
				$dispatcher	=	JEventDispatcher::getInstance();
				$parent		=	JCckDatabase::loadResult( 'SELECT parent FROM #__cck_core_types WHERE name = "'.$type.'"' );
				$fields		=	CCK_Form::getFields( array( $type, $parent ), 'all', -1, '', true );
				
				if ( count( $fields ) ) {
					foreach ( $fields as $field ) {
						$Pt		=	$field->storage_table;
						$value	=	'';
						
						/* Yes but, .. */

						if ( $Pt && ! isset( $config['storages'][$Pt] ) ) {
							$config['storages'][$Pt]	=	'';
							
							if ( $Pt == $table_name ) {
								$config['storages'][$Pt]	=	$item;
							} else {
								$dispatcher->trigger( 'onCCK_Storage_LocationPrepareDelete', array( &$field, &$config['storages'][$Pt], $pk, &$config ) );	
							}
						}
						$dispatcher->trigger( 'onCCK_StoragePrepareDelete', array( &$field, &$value, &$config['storages'][$Pt], &$config ) );
						$dispatcher->trigger( 'onCCK_FieldDelete', array( &$field, $value, &$config, array() ) );
					}
				}
			}
			// -- Leave nothing behind

			$table->delete();
		}

		// Processing
		JLoader::register( 'JCckToolbox', JPATH_PLATFORM.'/cms/cck/toolbox.php' );
		if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
			$event	=	'onCckConstructionAfterDelete';

			$this->_process( array( 'event', 'context', 'item' ), $event, $context, $item );
		}

		$tables	=	JCckDatabase::getTableList();
		$prefix	= 	JFactory::getConfig()->get( 'dbprefix' );
		
		if ( in_array( $prefix.'cck_store_item_'.$base, $tables ) ) {
			$table	=	JCckTable::getInstance( '#__cck_store_item_'.$base, 'id', $pk );
			if ( $table->id ) {
				$table->delete();
			}
		}
		
		if ( in_array( $prefix.'cck_store_form_'.$type, $tables ) ) {
			$table	=	JCckTable::getInstance( '#__cck_store_form_'.$type, 'id', $pk );
			if ( $table->id ) {
				$table->delete();
			}
		}

		if ( $parent != '' && in_array( $prefix.'cck_store_form_'.$parent, $tables ) ) {
			$table	=	JCckTable::getInstance( '#__cck_store_form_'.$parent, 'id', $pk );
			if ( $table->id ) {
				$table->delete();
			}
		}
		
		if ( isset( $config, $config['pk'] ) && $config['pk'] ) {
			if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
				$trigger_config	=	array(
										'pk'=>$config['pk'],
										'type'=>$config['type']
									);

				JCckToolbox::process( 'onCckPostAfterDelete', $trigger_config );
			}
		}
	}

	// onCckConstructionBeforeDelete
	public function onCckConstructionBeforeDelete( $context, $item )
	{
		if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
			$event	=	'onCckConstructionBeforeDelete';

			$this->_process( array( 'event', 'context', 'item' ), $event, $context, $item );
		}
	}

	// onCckConstructionAfterSave
	public function onCckConstructionAfterSave( $context, $item, $isNew )
	{
		if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
			$event	=	'onCckConstructionAfterSave';

			$this->_process( array( 'event', 'context', 'item', 'isNew' ), $event, $context, $item, $isNew );
		}
	}

	// onCckConstructionBeforeSave
	public function onCckConstructionBeforeSave( $context, $item, $isNew )
	{
		if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
			$event	=	'onCckConstructionBeforeSave';
			
			$this->_process( array( 'event', 'context', 'item', 'isNew' ), $event, $context, $item, $isNew );
		}
	}

	// onContentAfterDelete
	public function onContentAfterDelete( $context, $item )
	{
		if ( empty( $context ) ) {
			return false;
		}

		$db		=	JFactory::getDbo();
		$query	=	$db->getQuery( true )->select( 'name AS object' )
										 ->from( '#__cck_core_objects' )
										 ->where( 'context = '. $db->quote( $context ) );

		$db->setQuery( $query );
		$object	=	$db->loadResult();
		
		if ( ! $object ) {
			return true;
		}
		
		$table_key	=	$item->getKeyName();
		$table_name	=	$item->getTableName();
		$pk			= 	$item->$table_key;
		$base 		= 	str_replace( '#__', '', $table_name );
		
		require_once JPATH_SITE.'/plugins/cck_storage_location/'.$object.'/'.$object.'.php';
		$properties		= 	array( 'bridge_object', 'custom' );
		$properties		= 	JCck::callFunc( 'plgCCK_Storage_Location'.$object, 'getStaticProperties', $properties );
		$bridge_object 	= 	$properties['bridge_object'];
		$custom 		= 	$properties['custom'];
		$parent			=	'';
		$pkb			=	0;
		$type			=	'';

		// Core
		if ( $custom ) {
			preg_match( '#::cck::(\d+)::/cck::#U', $item->$custom, $matches );
			$id		=	$matches[1];

			if ( ! $id ) {
				return true;
			}

			$table	=	JCckTable::getInstance( '#__cck_core', 'id', $id );
			$type	=	$table->cck;
			$pkb	=	(int)$table->pkb;
		} else {
			$idx	=	array( 'pk'=>$pk, 'storage_location'=>$object );
			$table	=	JCckTable::getInstance( '#__cck_core' );

			if ( $object == 'free' ) {
				$idx['storage_table']	=	$table_name;
			}
			if ( $table->load( $idx ) ) {
				$type	=	$table->cck;
				$pkb	=	(int)$table->pkb;
			}
		}

		if ( $table->pk > 0 ) {
			// -- Leave nothing behind
			if ( $type != '' ) {
				require_once JPATH_LIBRARIES.'/cck/base/form/form.php';

				JPluginHelper::importPlugin( 'cck_field' );
				JPluginHelper::importPlugin( 'cck_storage' );
				JPluginHelper::importPlugin( 'cck_storage_location' );

				$config		=	array(
									'id'=>$table->id,
									'location'=>$table->storage_location,
									'pk'=>$table->pk,
									'storages'=>array(),
									'type'=>$table->cck
								);
				$dispatcher	=	JEventDispatcher::getInstance();
				$parent		=	JCckDatabase::loadResult( 'SELECT parent FROM #__cck_core_types WHERE name = "'.$type.'"' );
				$fields		=	CCK_Form::getFields( array( $type, $parent ), 'all', -1, '', true );
				
				if ( count( $fields ) ) {
					foreach ( $fields as $field ) {
						$Pt		=	$field->storage_table;
						$value	=	'';
						
						/* Yes but, .. */

						if ( $Pt && ! isset( $config['storages'][$Pt] ) ) {
							$config['storages'][$Pt]	=	'';
							
							if ( $Pt == $table_name ) {
								$config['storages'][$Pt]	=	$item;
							} else {
								$dispatcher->trigger( 'onCCK_Storage_LocationPrepareDelete', array( &$field, &$config['storages'][$Pt], $pk, &$config ) );	
							}
						}
						$dispatcher->trigger( 'onCCK_StoragePrepareDelete', array( &$field, &$value, &$config['storages'][$Pt], &$config ) );
						$dispatcher->trigger( 'onCCK_FieldDelete', array( &$field, $value, &$config, array() ) );
					}
				}
			}
			// -- Leave nothing behind

			$table->delete();

			if ( $pkb > 0 ) {
				if ( $bridge_object == 'joomla_category' ) {
					JLoader::register( 'JTableCategory', JPATH_PLATFORM.'/joomla/database/table/category.php' );

					$bridge	=	JTable::getInstance( 'Category' );
					$bridge->load( $pkb );
					$bridge->delete( $pkb );
				} elseif ( $bridge_object == 'joomla_article' ) {
					JLoader::register( 'JTableContent', JPATH_PLATFORM.'/joomla/database/table/content.php' );

					$bridge	=	JTable::getInstance( 'Content' );
					$bridge->load( $pkb );
					$bridge->delete( $pkb );
				}
			}
		}

		// Processing
		JLoader::register( 'JCckToolbox', JPATH_PLATFORM.'/cms/cck/toolbox.php' );
		if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
			$event		=	'onContentAfterDelete';
			$processing	=	JCckDatabaseCache::loadObjectListArray( 'SELECT type, scriptfile, options FROM #__cck_more_processings WHERE published = 1 ORDER BY ordering', 'type' );
			if ( isset( $processing[$event] ) ) {
				$data	=	$item;	/* Avoid B/C issue */

				foreach ( $processing[$event] as $p ) {
					if ( is_file( JPATH_SITE.$p->scriptfile ) ) {
						$options	=	new JRegistry( $p->options );

						include JPATH_SITE.$p->scriptfile;	/* Variables: $id, $item, $pk, $type */
					}
				}
			}
		}
		
		$tables	=	JCckDatabase::getTableList();
		$prefix	= 	JFactory::getConfig()->get( 'dbprefix' );
		
		if ( in_array( $prefix.'cck_store_item_'.$base, $tables ) ) {
			$table	=	JCckTable::getInstance( '#__cck_store_item_'.$base, 'id', $pk );
			if ( $table->id ) {
				$table->delete();
			}
		}
		
		if ( in_array( $prefix.'cck_store_form_'.$type, $tables ) ) {
			$table	=	JCckTable::getInstance( '#__cck_store_form_'.$type, 'id', $pk );
			if ( $table->id ) {
				$table->delete();
			}
		}

		if ( $parent != '' && in_array( $prefix.'cck_store_form_'.$parent, $tables ) ) {
			$table	=	JCckTable::getInstance( '#__cck_store_form_'.$parent, 'id', $pk );
			if ( $table->id ) {
				$table->delete();
			}
		}
		
		if ( isset( $config, $config['pk'] ) && $config['pk'] ) {
			if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
				unset( $config['storages'] );

				if ( $this->legacy && $this->legacy <= 2019 ) {
					JCckToolbox::process( 'onCckPostAfterDelete', $config );
				} else {
					$event		=	'onCckPostAfterDelete';
					$processing	=	JCckDatabaseCache::loadObjectListArray( 'SELECT type, scriptfile, options FROM #__cck_more_processings WHERE published = 1 ORDER BY ordering', 'type' );

					if ( isset( $processing[$event] ) ) {
						foreach ( $processing[$event] as $p ) {
							$process	=	new JCckProcessing( $event, JPATH_SITE.$p->scriptfile, $p->options );
							
							call_user_func_array( array( $process, 'execute' ), array( &$config, &$fields ) );
						}
					}
				}
			}
		}

		return true;
	}

	// onContentBeforeDelete
	public function onContentBeforeDelete( $context, $item )
	{
		if ( empty( $context ) ) {
			return false;
		}

		$db		=	JFactory::getDbo();
		$query	=	$db->getQuery( true )->select( 'name AS object' )
										 ->from( '#__cck_core_objects' )
										 ->where( 'context = '. $db->quote( $context ) );

		$db->setQuery( $query );
		$object	=	$db->loadResult();
		
		if ( ! $object ) {
			return true;
		}
		
		$table_key	=	$item->getKeyName();
		$table_name	=	$item->getTableName();
		$pk			= 	$item->$table_key;
		
		require_once JPATH_SITE.'/plugins/cck_storage_location/'.$object.'/'.$object.'.php';
		$properties		= 	array( 'bridge_object', 'custom' );
		$properties		= 	JCck::callFunc( 'plgCCK_Storage_Location'.$object, 'getStaticProperties', $properties );
		$custom 		= 	$properties['custom'];
		$parent			=	'';
		$pkb			=	0;
		$type			=	'';

		// Core
		if ( $custom ) {
			preg_match( '#::cck::(\d+)::/cck::#U', $item->$custom, $matches );
			$id		=	$matches[1];

			if ( ! $id ) {
				return true;
			}

			$table	=	JCckTable::getInstance( '#__cck_core', 'id', $id );
			$type	=	$table->cck;
			$pkb	=	(int)$table->pkb;
		} else {
			$idx	=	array( 'pk'=>$pk, 'storage_location'=>$object );
			$table	=	JCckTable::getInstance( '#__cck_core' );

			if ( $object == 'free' ) {
				$idx['storage_table']	=	$table_name;
			}
			if ( $table->load( $idx ) ) {
				$type	=	$table->cck;
				$pkb	=	(int)$table->pkb;
			}
		}

		if ( $table->pk > 0 ) {
			// -- Leave nothing behind
			if ( $type != '' ) {
				require_once JPATH_LIBRARIES.'/cck/base/form/form.php';

				JPluginHelper::importPlugin( 'cck_field' );
				JPluginHelper::importPlugin( 'cck_storage' );
				JPluginHelper::importPlugin( 'cck_storage_location' );

				$config		=	array(
									'id'=>$table->id,
									'location'=>$table->storage_location,
									'pk'=>$table->pk,
									'storages'=>array(),
									'type'=>$table->cck
								);
				$dispatcher	=	JEventDispatcher::getInstance();
				$parent		=	JCckDatabase::loadResult( 'SELECT parent FROM #__cck_core_types WHERE name = "'.$type.'"' );
				$fields		=	CCK_Form::getFields( array( $type, $parent ), 'all', -1, '', true );
				
				if ( count( $fields ) ) {
					foreach ( $fields as $field ) {
						$Pt		=	$field->storage_table;
						$value	=	'';
						
						/* Yes but, .. */

						if ( $Pt && ! isset( $config['storages'][$Pt] ) ) {
							$config['storages'][$Pt]	=	'';
							
							if ( $Pt == $table_name ) {
								$config['storages'][$Pt]	=	$item;
							} else {
								$dispatcher->trigger( 'onCCK_Storage_LocationPrepareDelete', array( &$field, &$config['storages'][$Pt], $pk, &$config ) );	
							}
						}
						$dispatcher->trigger( 'onCCK_StoragePrepareDelete', array( &$field, &$value, &$config['storages'][$Pt], &$config ) );
					}
				}
			}
			// -- Leave nothing behind
		}

		if ( isset( $config, $config['pk'] ) && $config['pk'] ) {
			if ( JCckToolbox::getConfig()->get( 'processing', 0 ) ) {
				if ( $this->legacy && $this->legacy <= 2019 ) {
					JCckToolbox::process( 'onCckPostBeforeDelete', $config );
				} else {
					$event		=	'onCckPostBeforeDelete';
					$processing	=	JCckDatabaseCache::loadObjectListArray( 'SELECT type, scriptfile, options FROM #__cck_more_processings WHERE published = 1 ORDER BY ordering', 'type' );

					if ( isset( $processing[$event] ) ) {
						foreach ( $processing[$event] as $p ) {
							$process	=	new JCckProcessing( $event, JPATH_SITE.$p->scriptfile, $p->options );
							$result		=	call_user_func_array( array( $process, 'execute' ), array( &$config, &$fields ) );

							if ( !$result ) {
								return false;
							}
						}
					}
				}
			}
		}

		return true;
	}

	// onContentBeforeDisplay
	public function onContentBeforeDisplay( $context, &$article, &$params, $limitstart = 0 )
	{
		if ( JCck::getConfig_Param( 'hide_edit_icon', 1 ) ) {
			if ( isset( $article->params ) && is_object( $article->params ) ) {
				$article->params->set( 'access-edit', false );
			}
		}
		
		return '';
	}
	
	// onContentPrepare
	public function onContentPrepare( $context, &$article, &$params, $limitstart = 0 )
	{
		if ( strpos( $article->text, '/cck' ) === false ) {
			if ( $this->legacy && $this->legacy <= 2019 ) {
				if ( strpos( $article->text, '{cck_item:' ) !== false ) {
					$article->text	=	$this->_replace( $article->text );
				}	
			} else {
				if ( strpos( $article->text, '<ins id=' ) !== false ) {
					$article->text	=	$this->_insert( $article->text );
				}
			}
			
			return true;
		}
		
		$this->_prepare( $context, $article, $params, $limitstart );
	}

	// _getValue
	protected function _getValue( $name, $target, $target2 )
	{
		if ( $name != '' ) {
			if ( isset( $target[$name] ) ) {
				return $target[$name]->value;
			} elseif ( isset( $target2[$name] ) ) {
				return $target2[$name]->value;
			}
		}

		return '';
	}
	
	// _prepare
	protected function _prepare( $context, &$article, &$params, $page = 0 )
	{
		$property	=	'text';
		preg_match( '#::cck::(\d+)::/cck::#U', $article->$property, $matches );
	  	
	  	if ( ! @$matches[1] ) {
			return;
		}

		$join			=	' LEFT JOIN #__cck_core_folders AS f ON f.id = b.folder';
		$join_select	=	', f.app as folder_app';
		$query			=	'SELECT a.id, a.pk, a.pkb, a.cck, a.storage_location, a.store_id, a.author_id AS author, b.id AS type_id, b.indexed, b.parent, b.parent_inherit, b.stylesheets,'
						.	' b.options_content, b.options_intro, c.template AS content_template, c.params AS content_params, d.template AS intro_template, d.params AS intro_params'.$join_select
						.	' FROM #__cck_core AS a'
						.	' LEFT JOIN #__cck_core_types AS b ON b.name = a.cck'
						.	' LEFT JOIN #__template_styles AS c ON c.id = b.template_content'
						.	' LEFT JOIN #__template_styles AS d ON d.id = b.template_intro'
						.	$join
						.	' WHERE a.id = "'.(string)$matches[1].'"'
						;
		$cck			=	JCckDatabase::loadObject( $query );

		if ( !is_object( $cck ) ) {
			return;
		}
		$contentType	=	(string)$cck->cck;
		$parent_type	=	$cck->parent_inherit ? (string)$cck->parent : '';
		
		if ( ! $contentType ) {
			return;
		}
		
		JPluginHelper::importPlugin( 'cck_storage_location' );

		if ( $context == 'text' ) {
			$client	=	'intro';
		} elseif ( $context == 'com_finder.indexer' ) {
			if ( $cck->indexed == 'none' ) {
				$article->$property		=	'';
				return;
			}
			$client	=	( empty( $cck->indexed ) ) ? 'intro' : $cck->indexed;
		} else {
			if ( $cck->storage_location != '' ) {
				$properties	=	array( 'contexts' );
				$properties	=	JCck::callFunc( 'plgCCK_Storage_Location'.$cck->storage_location, 'getStaticProperties', $properties );
				$client		=	( in_array( $context, $properties['contexts'] ) ) ? 'content' : 'intro';
			} else {
				$client		=	'intro';
			}
		}
		
		// Fields
		$app 	=	JFactory::getApplication();
		$fields	=	array();
		$lang	=	JFactory::getLanguage();
		$user	=	JFactory::getUser();
		$access	=	implode( ',', $user->getAuthorisedViewLevels() );
		
		if ( $client == 'intro' && $this->cache ) {
			$query		=	'SELECT cc.*, c.ordering, c.label as label2, c.variation_override, c.link, c.link_options, c.markup, c.markup_class, c.typo, c.typo_label, c.typo_options, c.access, c.restriction, c.restriction_options, c.position'
						.	' FROM #__cck_core_type_field AS c'
						.	' LEFT JOIN #__cck_core_types AS sc ON sc.id = c.typeid'
						.	' LEFT JOIN #__cck_core_fields AS cc ON cc.id = c.fieldid'
						.	' WHERE sc.name = "'.$contentType.'" AND sc.published = 1 AND c.client = "'.$client.'" AND c.access IN ('.$access.')'
						.	' ORDER BY c.ordering ASC'
						;
			$fields		=	JCckDatabaseCache::loadObjectList( $query, 'name' );	//#
			if ( ! count( $fields ) && $client == 'intro' ) {
				$client	=	'content';
				$query	=	'SELECT cc.*, c.ordering, c.label as label2, c.variation_override, c.link, c.link_options, c.markup, c.markup_class, c.typo, c.typo_label, c.typo_options, c.access, c.restriction, c.restriction_options, c.position'
						.	' FROM #__cck_core_type_field AS c'
						.	' LEFT JOIN #__cck_core_types AS sc ON sc.id = c.typeid'
						.	' LEFT JOIN #__cck_core_fields AS cc ON cc.id = c.fieldid'
						.	' WHERE sc.name = "'.$contentType.'" AND sc.published = 1 AND c.client = "'.$client.'" AND c.access IN ('.$access.')'
						.	' ORDER BY c.ordering ASC'
						;
				$fields	=	JCckDatabaseCache::loadObjectList( $query, 'name' );	//#
			}
		} else {
			if ( $parent_type != '' ) {
				$w_type	=	'(sc.name = "'.$contentType.'" OR sc.name = "'.$parent_type.'")';
			} else {
				$w_type	=	'sc.name = "'.$contentType.'"';	
			}
			$query		=	'SELECT cc.*, c.ordering, c.label as label2, c.variation_override, c.link, c.link_options, c.markup, c.markup_class, c.typo, c.typo_label, c.typo_options, c.access, c.restriction, c.restriction_options, c.position'
						.	' FROM #__cck_core_type_field AS c'
						.	' LEFT JOIN #__cck_core_types AS sc ON sc.id = c.typeid'
						.	' LEFT JOIN #__cck_core_fields AS cc ON cc.id = c.fieldid'
						.	' WHERE '.$w_type.' AND sc.published = 1 AND c.client = "'.$client.'" AND c.access IN ('.$access.')'
						.	' ORDER BY'
						;
			if ( $parent_type != '' ) {
				$query	.=	' c.typeid ASC,';
			}
			$query		.=	' c.ordering ASC';
			$fields		=	JCckDatabase::loadObjectList( $query, 'name' );	//#
			if ( ! count( $fields ) && $client == 'intro' ) {
				$client	=	'content';
				$query	=	'SELECT cc.*, c.ordering, c.label as label2, c.variation_override, c.link, c.link_options, c.markup, c.markup_class, c.typo, c.typo_label, c.typo_options, c.access, c.restriction, c.restriction_options, c.position'
						.	' FROM #__cck_core_type_field AS c'
						.	' LEFT JOIN #__cck_core_types AS sc ON sc.id = c.typeid'
						.	' LEFT JOIN #__cck_core_fields AS cc ON cc.id = c.fieldid'
						.	' WHERE '.$w_type.' AND sc.published = 1 AND c.client = "'.$client.'" AND c.access IN ('.$access.')'
						.	' ORDER BY'
						;
				if ( $parent_type != '' ) {
					$query	.=	' c.typeid ASC,';
				}
				$query	.=	' c.ordering ASC';
				$fields	=	JCckDatabase::loadObjectList( $query, 'name' );	//#
			}
		}

		// Versionning
		/*
		if ( JCck::isSite( true, 'production' ) ) {
			echo 'prod';
		} else {
			echo 'dev';
		}
		*/

		if ( !isset( $this->loaded[$contentType.'_'.$client.'_options'] ) ) {
			$lang->load( 'pkg_app_cck_'.$cck->folder_app, JPATH_SITE, null, false, false );

			$lang_tag	=	$lang->getTag();
			$registry	=	new JRegistry;
			$registry->loadString( $cck->{'options_'.$client} );

			$this->loaded[$contentType.'_'.$client.'_options']	=	$registry->toArray();

			if ( isset( $this->loaded[$contentType.'_'.$client.'_options']['sef'] ) ) {
				if ( $this->loaded[$contentType.'_'.$client.'_options']['sef'] == '' ) {
					$this->loaded[$contentType.'_'.$client.'_options']['sef']	=	JCck::getConfig_Param( 'sef', '23' );
				}
			}
			if ( isset( $this->loaded[$contentType.'_'.$client.'_options']['metadesc'] ) ) {
				if ( $this->loaded[$contentType.'_'.$client.'_options']['metadesc'] != '' && $this->loaded[$contentType.'_'.$client.'_options']['metadesc'][0]	==	'{' ) {
					$json		=	json_decode( $this->loaded[$contentType.'_'.$client.'_options']['metadesc'] );

					$this->loaded[$contentType.'_'.$client.'_options']['metadesc']	=	( isset( $json->$lang_tag ) ) ? $json->$lang_tag : '';
				}
			}
			if ( isset( $this->loaded[$contentType.'_'.$client.'_options']['metatitle'] ) ) {
				if ( $this->loaded[$contentType.'_'.$client.'_options']['metatitle'] != '' && $this->loaded[$contentType.'_'.$client.'_options']['metatitle'][0]	==	'{' ) {
					$json		=	json_decode( $this->loaded[$contentType.'_'.$client.'_options']['metatitle'] );

					$this->loaded[$contentType.'_'.$client.'_options']['metatitle']	=	( isset( $json->$lang_tag ) ) ? $json->$lang_tag : '';
				}
			}
			if ( isset( $this->loaded[$contentType.'_'.$client.'_options']['desc'] ) ) {
				if ( $this->loaded[$contentType.'_'.$client.'_options']['desc'] != '' && $this->loaded[$contentType.'_'.$client.'_options']['desc'][0]	==	'{' ) {
					$json		=	json_decode( $this->loaded[$contentType.'_'.$client.'_options']['desc'] );

					$this->loaded[$contentType.'_'.$client.'_options']['desc']	=	( isset( $json->$lang_tag ) ) ? $json->$lang_tag : '';
				}
			}
			if ( isset( $this->loaded[$contentType.'_'.$client.'_options']['title'] ) ) {
				if ( $this->loaded[$contentType.'_'.$client.'_options']['title'] != '' && $this->loaded[$contentType.'_'.$client.'_options']['title'][0]	==	'{' ) {
					$json		=	json_decode( $this->loaded[$contentType.'_'.$client.'_options']['title'] );

					$this->loaded[$contentType.'_'.$client.'_options']['title']	=	( isset( $json->$lang_tag ) ) ? $json->$lang_tag : '';
				}
			}
		}
		
		// Template
		$tpl['home']							=	$app->getTemplate();
		$tpl['folder']							=	$cck->{$client.'_template'};
		$tpl['params']							=	json_decode( $cck->{$client.'_params'}, true );
		$tpl['params']['rendering_css_core']	=	$cck->stylesheets;
		
		if ( file_exists( JPATH_SITE.'/templates/'.$tpl['home'].'/html/tpl_'.$tpl['folder'] ) ) {
			$tpl['folder']	=	'tpl_'.$tpl['folder'];
			$tpl['root']	=	JPATH_SITE.'/templates/'.$tpl['home'].'/html';
		} else {
			$tpl['root']	=	JPATH_SITE.'/templates';
		}
		$tpl['path']		=	$tpl['root'].'/'.$tpl['folder'];
		
		if ( ! $tpl['folder'] || ! file_exists( $tpl['path'].'/index.php' ) ) {
			$article->$property		=	str_replace( $article->$property, 'Template Style does not exist. Open the Content Type & save it again. (Intro + Content views)', $article->$property );

			if ( JCck::on( '3.8' ) && isset( $article->introtext ) ) {
				$article->introtext	=	'';
			}
			return;
		}
		
		$this->_render( $context, $article, $params, $tpl, $contentType, $fields, $property, $client, $cck, $parent_type );
	}
	
	// _process
	protected function _process()
	{
		$args	=	func_get_args();
		
		if ( count( $args ) ) {
			$i		=	0;
			$keys	=	array_shift( $args );

			if ( count( $keys ) ) {
				foreach ( $args as $arg ) {
					${$keys[$i++]}	=	$arg;
				}
			}
		}
		$processing	=	JCckDatabaseCache::loadObjectListArray( 'SELECT type, scriptfile, options FROM #__cck_more_processings WHERE published = 1 ORDER BY ordering', 'type' );
		
		unset( $args );

		if ( isset( $processing[$event] ) ) {
			foreach ( $processing[$event] as $p ) {
				if ( is_file( JPATH_SITE.$p->scriptfile ) ) {
					$options	=	new JRegistry( $p->options );

					include JPATH_SITE.$p->scriptfile;
				}
			}
		}
	}

	// _render
	protected function _render( $context, &$article, &$article_params, $tpl, $contentType, $fields, $property, $client, $cck, $parent_type )
	{
		$app		=	JFactory::getApplication();
		$dispatcher	=	JEventDispatcher::getInstance();
		$user		=	JFactory::getUser();
		$params		=	array( 'template'=>$tpl['folder'], 'file'=>'index.php', 'directory'=>$tpl['root'] );
		
		$lang			=	JFactory::getLanguage();
		$lang_default	=	$lang->getDefault();
		$lang_tag		=	$lang->getTag();

		$lang->load( 'com_cck_default', JPATH_SITE );
		
		JPluginHelper::importPlugin( 'cck_field' );
		JPluginHelper::importPlugin( 'cck_field_link' );
		JPluginHelper::importPlugin( 'cck_field_restriction' );
		JPluginHelper::importPlugin( 'cck_field_typo' );

		$p_desc			=	isset( $this->loaded[$contentType.'_'.$client.'_options']['desc'] ) ? $this->loaded[$contentType.'_'.$client.'_options']['desc'] : '';
		$p_metadesc		=	isset( $this->loaded[$contentType.'_'.$client.'_options']['metadesc'] ) ? $this->loaded[$contentType.'_'.$client.'_options']['metadesc'] : '';
		$p_metatitle	=	isset( $this->loaded[$contentType.'_'.$client.'_options']['metatitle'] ) ? $this->loaded[$contentType.'_'.$client.'_options']['metatitle'] : '';
		$p_sef			=	isset( $this->loaded[$contentType.'_'.$client.'_options']['sef'] ) ? $this->loaded[$contentType.'_'.$client.'_options']['sef'] : JCck::getConfig_Param( 'sef', '23' );
		$p_title		=	isset( $this->loaded[$contentType.'_'.$client.'_options']['title'] ) ? $this->loaded[$contentType.'_'.$client.'_options']['title'] : '';

		jimport( 'cck.rendering.document.document' );

		$doc		=	CCK_Document::getInstance( 'html' );
		$positions	=	array();
		$unset		=	array();

		if ( $parent_type != '' ) {
			$w_type	=	'(b.name = "'.$contentType.'" OR b.name = "'.$parent_type.'")';
		} else {
			$w_type	=	'b.name = "'.$contentType.'"';
		}
		if ( $client == 'intro' /* && $this->cache */ ) {
			$positions_more	=	JCckDatabaseCache::loadObjectList( 'SELECT * FROM #__cck_core_type_position AS a LEFT JOIN #__cck_core_types AS b ON b.id = a.typeid'
																 . ' WHERE '.$w_type.' AND a.client ="'.$client.'"', 'position' );	/* TODO#SEBLOD: improve */
		} else {
			$positions_more	=	JCckDatabase::loadObjectList( 'SELECT * FROM #__cck_core_type_position AS a LEFT JOIN #__cck_core_types AS b ON b.id = a.typeid'
															. ' WHERE '.$w_type.' AND a.client ="'.$client.'"', 'position' );	/* TODO#SEBLOD: improve */
		}

		// Fields
		if ( count( $fields ) ) {
			JPluginHelper::importPlugin( 'cck_storage' );

			$config		=	array( 'author'=>$cck->author,
							   'client'=>$client,
							   'context'=>array(),
   							   'doSEF'=>$p_sef,
							   'doTranslation'=>JCck::getConfig_Param( 'language_jtext', 1 ),
							   'error'=>0,
							   'fields'=>array(),
							   'id'=>$cck->id,
							   'isNew'=>0,
							   'Itemid'=>$app->input->getInt( 'Itemid', 0 ),
							   'location'=>$cck->storage_location,
							   'pk'=>$cck->pk,
							   'pkb'=>$cck->pkb,
							   'storages'=>array(),
							   'store_id'=>(int)$cck->store_id,
							   'type'=>$cck->cck,
							   'type_id'=>(int)$cck->type_id
							);

			if ( is_array( $article_params ) ) {
				$config['context']	=	$article_params;
			}

			foreach ( $fields as $field ) {
				$field->typo_target	=	'value';
				$fieldName			=	$field->name;
				$value				=	'';
				if ( $fieldName ) {
					$Pt	=	$field->storage_table;
					if ( $Pt && ! isset( $config['storages'][$Pt] ) ) {
						$config['storages'][$Pt]	=	'';
						$dispatcher->trigger( 'onCCK_Storage_LocationPrepareContent', array( &$field, &$config['storages'][$Pt], $config['pk'], &$config, &$article ) );
					}
					
					$dispatcher->trigger( 'onCCK_StoragePrepareContent', array( &$field, &$value, &$config['storages'][$Pt] ) );
					
					if ( is_string( $value ) ) {
						$storage_mode	=	(int)$field->storage_mode;
						$value			=	trim( $value );

						if ( $storage_mode && $value != '' ) {
							if ( $storage_mode == -1 ) {
								$json		=	json_decode( $value );
								$value		=	isset( $json->$lang_default ) ? $json->$lang_default : '';
							} elseif ( $storage_mode == 1 ) {
								$json		=	json_decode( $value );
								$value		=	isset( $json->$lang_tag ) ? $json->$lang_tag : '';
							}
						}
					}
					
					$hasLink	=	( $field->link != '' ) ? 1 : 0;
					$dispatcher->trigger( 'onCCK_FieldPrepareContent', array( &$field, $value, &$config ) );
					$target		=	$field->typo_target;
					if ( $hasLink ) {
						$dispatcher->trigger( 'onCCK_Field_LinkPrepareContent', array( &$field, &$config ) );
						if ( $field->link ) {
							JCckPluginLink::g_setHtml( $field, $target );
						}
					}
					if ( @$field->typo && ( $field->$target !== '' || $field->typo_label == -2 ) ) {
						$dispatcher->trigger( 'onCCK_Field_TypoPrepareContent', array( &$field, $field->typo_target, &$config ) );
					} else {
						$field->typo	=	'';
					}
					$position					=	$field->position;
					$positions[$position][]		=	$fieldName;

					// Was it the last one?
					if ( $field->type == 'cck_break' && isset( $field->process ) ) {
						if ( $field->process->type ) {
							if ( !JCck::callFunc_Array( 'plg'.$field->process->group.$field->process->type, 'on'.$field->process->group.'BeforeRenderContent', array( $field->process->params, &$fields, &$config['storages'], &$config ) ) ) {
								$config['error']	=	0;
							}
						}
					}
					if ( $config['error'] ) {
						break;
					}
				}
			}
			
			$v_desc			=	$this->_getValue( $p_desc, $fields, $config['fields'] );
			$v_metadesc		=	$this->_getValue( $p_metadesc, $fields, $config['fields'] );
			$v_metatitle	=	$this->_getValue( $p_metatitle, $fields, $config['fields'] );
			$v_title		=	$this->_getValue( $p_title, $fields, $config['fields'] );

			// Merge
			if ( count( $config['fields'] ) ) {
				foreach ( $config['fields'] as $k=>$v ) {
					if ( $v->markup == 'unset' && isset( $fields[$k] ) ) {
						$unset[$k]	=	$fields[$k];
					}
					if ( !( $v->restriction == 'unset' ) ) {
						$fields[$k]	=	$v;
					}
				}
				$config['fields']	=	null;
				unset( $config['fields'] );
			}
		}
		
		// BeforeRender
		if ( isset( $config['process']['beforeRenderContent'] ) && count( $config['process']['beforeRenderContent'] ) ) {
			JCckDevHelper::sortObjectsByProperty( $config['process']['beforeRenderContent'], 'priority' );

			foreach ( $config['process']['beforeRenderContent'] as $process ) {
				if ( $process->type ) {
					JCck::callFunc_Array( 'plg'.$process->group.$process->type, 'on'.$process->group.'BeforeRenderContent', array( $process->params, &$fields, &$config['storages'], &$config ) );
				}
			}
		}
		if ( count( $unset ) ) {
			foreach ( $unset as $k=>$v ) {
				$fields[$k]	=	$v;
			}
			unset( $unset );
		}

		// Set Title
		if ( !empty( $v_title ) ) {
 			$p_title		=	$this->_translate( $v_title, $lang_tag );
 		}
 		if ( $p_title == '' && !empty( $v_metatitle ) ) {
 			$p_title		=	$this->_translate( $v_metatitle, $lang_tag );
 			$p_title		=	strip_tags( $p_title );
			$p_title		=	JCckDevHelper::truncate( $p_title, 70 );
 		}
 		if ( $p_title != '' ) {
 			$app->cck_page_title	=	$p_title;
 		}

 		// Set Description
		if ( !empty( $v_desc ) ) {
 			$p_desc			=	$this->_translate( $v_desc, $lang_tag );
 		}
 		if ( $p_desc == '' && !empty( $v_metadesc ) ) {
 			$p_desc			=	$this->_translate( $v_metadesc, $lang_tag );
 			$p_desc			=	strip_tags( $p_desc );
			$p_desc			=	JCckDevHelper::truncate( $p_desc, 200 );
		}
		if ( $p_desc != '' ) {
 			if ( is_object( $article ) && isset( $article->metadesc ) && $article->metadesc == '' ) {
				$article->metadesc	=	$p_desc;
			}

			JFactory::getDocument()->setDescription( $p_desc );
 		}

		// Finalize
		$doc->fields	=	&$fields;
		$infos			=	array( 'context'=>$context, 'params'=>$tpl['params'], 'path'=>$tpl['path'], 'root'=>JUri::root( true ), 'template'=>$tpl['folder'], 'theme'=>$tpl['home'] );
		$doc->finalize( 'content', $contentType, $client, $positions, $positions_more, $infos, $cck->id );
		
		$data					=	$doc->render( false, $params );

		if ( $this->legacy && $this->legacy <= 2019 ) {
			if ( strpos( $data, '{cck_item:' ) !== false ) {
				$data	=	$this->_replace( $data );
			}
		} else {
			if ( strpos( $data, '<ins id=' ) !== false ) {
				$data	=	$this->_insert( $data );
			}
		}

		$article->$property		=	str_replace( $article->$property, $data, $article->$property );
	}

	// _insert
	protected function _insert( $text )
	{
		jimport( 'cck.base.item.item' );

		$matches	=	array();
		$regex		=	'/\<ins id="(\d+)"(.*)?\>(.*)\<\/ins\>/';

		preg_match_all( $regex, $text, $matches );

		if ( isset( $matches[1] ) && is_array( $matches[1] ) ) {
			foreach ( $matches[1] as $k=>$id ) {
				if ( isset( $matches[2][$k] ) && $matches[2][$k] != '' ) {
					$params	=	trim( $matches[2][$k] );

					if ( $params ) {
						$params	=	$this->_insertParams( $params );
					} else {
						$params	=	'{}';
					}
				} else {
					$params	=	'{}';
				}

				$params	=	new JRegistry( $params );
				$data	=	CCK_Item::render( $id, $params->toArray(), false );
				$text	=	str_replace( $matches[0][$k], $data, $text );
			}
		}

		return $text;
	}

	// _insertParams
	protected function _insertParams( $string )
	{
		$params	=	array();
		$parts	=	explode( ' ', $string );

		foreach ( $parts as $part ) {
			$val	=	explode( '=', $part );

			if ( $val[0] ) {
				$v					=	$val[1];

				if ( $v != '' ) {
					$len	=	strlen( $v );
					$v		=	substr( $v, 1, $len - 2 );
				}
				$params[$val[0]]	=	$v;
			}
		}

		return $params;
	}

	// _replace
	protected function _replace( $text )
	{
		jimport( 'cck.base.item.item' );

		$matches	=	array();
		$regex		=	'/{cck_item:(\d+)( {(.*)})?}/';

		preg_match_all( $regex, $text, $matches );
		
		if ( isset( $matches[1] ) && is_array( $matches[1] ) ) {
			foreach ( $matches[1] as $k=>$id ) {
				if ( isset( $matches[2][$k] ) && $matches[2][$k] ) {
					$params	=	$matches[2][$k];
				} else {
					$params	=	'{}';
				}

				$params	=	new JRegistry( $params );
				$data	=	CCK_Item::render( $id, $params->toArray(), false );
				$text	=	str_replace( $matches[0][$k], $data, $text );
			}
		}

		return $text;
	}

	// _translate
	protected function _translate( $str, $lang_tag )
	{
		if ( $str == '' ) {
 			return $str;
		}

		if ( $str[0] == '{' ) {
			$json	=	json_decode( $str );
			$str	=	isset( $json->$lang_tag ) ? $json->$lang_tag : '';
		}

		return $str;
	}
}
?>