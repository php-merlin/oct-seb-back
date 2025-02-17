<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: script.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;
defined( 'CCK_COM' ) or define( 'CCK_COM', 'com_cck' );

jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.folder' );

// Script
class plgContentCCKInstallerScript
{
	// install
	public function install( $parent )
	{
		$data	=	"<!DOCTYPE html><title></title>";
		$groups	=	array( 'cck_field', 'cck_field_link', 'cck_field_live', 'cck_field_restriction', 'cck_field_typo', 'cck_field_validation', 'cck_storage', 'cck_storage_location' );
		foreach ( $groups as $group ) {
			JFile::write( JPATH_PLUGINS.'/'.$group.'/'.'index.html', $data );	
		}
	}
	
	// uninstall
	public function uninstall( $parent )
	{
		if ( JFile::exists( JPATH_ADMINISTRATOR.'/language/en-GB/en-GB.lib_cck.ini' ) ) {
			JFile::delete( JPATH_ADMINISTRATOR.'/language/en-GB/en-GB.lib_cck.ini' );
		}
		if ( JFile::exists( JPATH_ADMINISTRATOR.'/language/fr-FR/fr-FR.lib_cck.ini' ) ) {
			JFile::delete( JPATH_ADMINISTRATOR.'/language/fr-FR/fr-FR.lib_cck.ini' );
		}
		
		$groups	=	array(
						'cck_field',
						'cck_field_link',
						'cck_field_live',
						'cck_field_restriction',
						'cck_field_typo',
						'cck_field_validation',
						'cck_storage',
						'cck_storage_location'
					);
		
		foreach ( $groups as $group ) {
			if ( JFolder::exists( JPATH_PLUGINS.'/'.$group ) ) {
				JFolder::delete( JPATH_PLUGINS.'/'.$group );
			}
		}

		// Additional stuff
		$path	=	JPATH_SITE.'/cli/cck_job.php';

		if ( JFile::exists( $path ) ) {
			JFile::delete( $path );
		}

		$path	=	JPATH_SITE.'/libraries/cms/cck';

		if ( JFolder::exists( $path ) ) {
			JFolder::delete( $path );
		}
	}
	
	// preflight
	public function preflight( $type, $parent )
	{
		// WAITING FOR JOOMLA 1.7.x FIX
		$app		=	JFactory::getApplication();
		$config		=	JFactory::getConfig();
		$tmp_path	=	$config->get( 'tmp_path' );
		$tmp_dir 	=	$app->cck_core_temp_var;
		$path 		= 	$tmp_path.'/'.$tmp_dir;
		$dest		=	JPATH_SITE.'/libraries/cck/rendering/variations';
		$protected	=	array( 'empty' );
		if ( $tmp_dir && JFolder::exists( $path ) ) {
			$vars		=	JFolder::folders( $path );
			foreach ( $vars as $var ) {
				if ( ! in_array( $var, $protected ) ) {
					JFolder::move( $path.'/'.$var, $dest.'/'.$var );
				}
			}
			JFolder::delete( $path );
		}
		// WAITING FOR JOOMLA 1.7.x FIX
	}
	
	// postflight
	public function postflight( $type, $parent )
	{
		$app	=	JFactory::getApplication();
		$db		=	JFactory::getDbo();
		
		// Force { CCK } Plugins + { CCK } Library to be published
		$db->setQuery( 'UPDATE #__extensions SET enabled = 1 WHERE element = "cck"' );
		$db->execute();
		
		// Rename Menu Item
		$db->setQuery( 'UPDATE #__menu SET title = "com_cck", alias = "SEBLOD", path="SEBLOD" WHERE link = "index.php?option=com_cck"' );
		$db->execute();

		// Re-build menu
		$query	=	'SELECT id, level, lft, path FROM #__menu WHERE link = "index.php?option=com_cck"';

		$db->setQuery( $query );
		$seblod	=	$db->loadObject();

		if ( $seblod->id > 0 ) {		
			$query	=	'SELECT extension_id as id, element FROM #__extensions WHERE type = "component" AND element LIKE "com_cck_%" ORDER BY name';

			$db->setQuery( $query );
			
			$addons	=	$db->loadObjectList();
			
			if ( count( $addons ) ) {			
				JLoader::register( 'JTableMenu', JPATH_PLATFORM.'/joomla/database/table/menu.php' );
				$titles	=	array(
								'com_cck_builder'=>'Builder',
								'com_cck_developer'=>'Developer',
								'com_cck_ecommerce'=>'eCommerce',
								'com_cck_exporter'=>'Exporter',
								'com_cck_importer'=>'Importer',
								'com_cck_manager'=>'Manager',
								'com_cck_multilingual'=>'Multilingual',
								'com_cck_packager'=>'Packager',
								'com_cck_toolbox'=>'Toolbox',
								'com_cck_updater'=>'Updater',
								'com_cck_webservices'=>'WebServices'
							);
				foreach ( $addons as $addon ) {
					$addon->title	=	$titles[$addon->element];
					self::_addAddon( $addon, $seblod, $type );
				}
			}
		}	
		
		$params =	JComponentHelper::getParams( 'com_cck' );

		// Reorder Plugins
		self::_reorderPlugins( 'content' );
		self::_reorderPlugins( 'system' );

		$db->setQuery( 'UPDATE #__extensions SET ordering = 0 WHERE type = "plugin" AND folder = "system" AND element = "languagefilter"' );
		$db->execute();
		
		if ( $type == 'install' ) {
			// Manage Back-end Modules
			$modules	=	array(
								0=>array( 'name'=>'mod_cck_quickadd', 'task'=>'update', 'update'=>'title = "Quick Add - SEBLOD", access = 3, published = 1, position = "status", ordering = 0' ),
								1=>array( 'name'=>'mod_cck_quickicon', 'task'=>'update', 'update'=>'title = "Quick Icons - SEBLOD", access = 3, published = 1, position = "icon", ordering = 2' )
							);
			foreach ( $modules as $module ) {
				$query	=	'UPDATE #__modules SET '.$module['update'].' WHERE module = "'.$module['name'].'"';
				$db->setQuery( $query );
				$db->execute();
				$query	=	'SELECT id FROM #__modules WHERE module="'.$module['name'].'"';
				$db->setQuery( $query );
				$mid	=	$db->loadResult();
				
				try {
					$query	=	'INSERT INTO #__modules_menu (moduleid, menuid) VALUES ('.$mid.', 0)';
					$db->setQuery( $query );
					$db->execute();
				} catch ( Exception $e ) {
					// Do nothing
				}
			}

			// Delete Front-end Modules
			$query	=	'DELETE a.* FROM #__modules AS a WHERE a.module IN ("mod_cck_breadcrumbs","mod_cck_form","mod_cck_item","mod_cck_list","mod_cck_search")';
			$db->setQuery( $query );
			$db->execute();

			// Publish Plugins
			$query	=	'UPDATE #__extensions SET enabled = 1 WHERE folder LIKE "cck_%"';
			$db->setQuery( $query );
			$db->execute();

			// Set Template Styles
			$query			=	'SELECT id, params FROM #__template_styles WHERE template="seb_minima" ORDER BY id';
			$db->setQuery( $query );
			$style			=	$db->loadObject();
			$style_params	=	'{"rendering_css_class":"","rendering_custom_attributes":"",'.substr( $style->params, 1 );
			
			$query			=	'UPDATE #__template_styles SET params = "'.$db->escape( $style_params ).'" WHERE id = '.(int)$style->id;
			$db->setQuery( $query );
			$db->execute();
			
			$query			=	'SELECT id, params FROM #__template_styles WHERE template="seb_list" ORDER BY id';
			$db->setQuery( $query );
			$style2			=	$db->loadObject();
			$style2_params	=	'{"rendering_item_attributes":"","rendering_css_class":"",'.substr( $style2->params, 1 );
			
			$query			=	'UPDATE #__template_styles SET params = "'.$db->escape( $style2_params ).'" WHERE id = '.(int)$style2->id;
			$db->setQuery( $query );
			$db->execute();
			
			$query			=	'SELECT id, params FROM #__template_styles WHERE template="seb_table" ORDER BY id';
			$db->setQuery( $query );
			$style3			=	$db->loadObject();
			$style3_params	=	'{"rendering_item_attributes":"","rendering_css_class":"",'.substr( $style3->params, 1 );

			$query			=	'UPDATE #__template_styles SET params = "'.$db->escape( $style3_params ).'" WHERE id = '.(int)$style3->id;
			$db->setQuery( $query );
			$db->execute();
			


// Add Categories
JLoader::register( 'JTableCategory', JPATH_PLATFORM.'/joomla/database/table/category.php' );
$categories	=	array(	0=>array( 'title'=>'Users', 'published'=>'1', 'access'=>'2', 'language'=>'*', 'parent_id'=>1, 'plg_name'=>'joomla_user' ),
						1=>array( 'title'=>'User Groups', 'published'=>'1', 'access'=>'2', 'language'=>'*', 'parent_id'=>1, 'plg_name'=>'joomla_user_group' ) );

foreach ( $categories as $category ) {
	$table	=	JTable::getInstance( 'Category' );
	$table->access	=	2;
	$table->setLocation( 1, 'last-child' );	
	$table->bind( $category );
	$rules	=	new JAccessRules( '{"core.create":{"1":0}}' );
	$table->setRules( $rules );
	$table->check();
	$table->extension	=	'com_content';
	$table->path		.=	$table->alias;
	$table->language	=	'*';
	$table->store();
	
	$query			=	'SELECT extension_id as id, params FROM #__extensions WHERE type="plugin" AND folder="cck_storage_location" AND element="'.$category['plg_name'].'"';
	$db->setQuery( $query );
	$plugin			=	$db->loadObject();
	$query			=	'UPDATE #__extensions SET params = "'.$db->escape( str_replace( '"bridge_default-catid":"2"', '"bridge_default-catid":"'.$table->id.'"', $plugin->params ) ).'" WHERE extension_id = '.(int)$plugin->id;
	$db->setQuery( $query );
	$db->execute();
}
			
			// Init Default Author
			$res	=	JCckDatabase::loadResult( 'SELECT id FROM #__users ORDER BY id ASC' );
			$params->set( 'integration_user_default_author', (int)$res );
			$db->setQuery( 'UPDATE #__extensions SET params = "'.$db->escape( $params ).'" WHERE name = "com_cck"' );
			$db->execute();
			
			// Init Default Config
			$params->set( 'core_legacy', '0' );
			$params->set( 'core_legacy_routing', '0' );
			$params->set( 'sef_canonical_list', '1' );
			$params->set( 'sef_aliases', '2' );
			$params->set( 'site_variation', 'seb_css3b' );
			$params->set( 'site_variation_form', 'seb_css3b' );
			$params->set( 'optimize_memory', '11' );
			
			// Init ACL
			require_once JPATH_ADMINISTRATOR.'/components/com_cck/helpers/helper_admin.php';
			$pks	=	JCckDatabase::loadColumn( 'SELECT id FROM #__cck_core_types WHERE location != "collection" ORDER BY id' );
			if ( count( $pks ) ) {
				$rules	=	'{"core.create.max.parent":{"8":0},"core.create.max.parent.author":{"8":0},"core.create.max.author":{"8":0}}';
				$rules2	=	array(
								8=>'{"core.create":{"1":true,"2":false},"core.create.max.parent":{"8":0},"core.create.max.parent.author":{"8":0},"core.create.max.author":{"8":0},"core.edit":{"4":false},"core.edit.own":{"2":true}}',
								50=>'{"core.create":{"1":true},"core.create.max.parent":{"8":0},"core.create.max.parent.author":{"8":0},"core.create.max.author":{"8":0}}'
							);
				Helper_Admin::initACL( array( 'table'=>'type', 'name'=>'form', 'rules'=>$rules ), $pks, $rules2 );
			}

			// Set Initial Version
			$params->set( 'initial_version', $app->cck_core_version );
			
			// Set User Actions Log
			self::_setUserActionsLog();

			// Set Utf8mb4 flag
			self::_setUtf8mb4( $params );
		} else {
			$new		=	$app->cck_core_version;
			$old		=	$app->cck_core_version_old;

			// Set User Actions Log
			self::_setUserActionsLog();

			// Convert Tables To Utf8mb4
			self::_convertTablesToUtf8mb4();

			// Rebuild Folder Tree
			require_once JPATH_ADMINISTRATOR.'/components/'.CCK_COM.'/helpers/helper_folder.php';

			Helper_Folder::rebuildTree( 2, 1 );
		}

		$params->set( 'media_version', md5( $app->cck_core_version . JFactory::getConfig()->get( 'secret' ) ) );

		// Update Params
		$db->setQuery( 'UPDATE #__extensions SET params = "'.$db->escape( $params ).'" WHERE name = "com_cck"' );
		$db->execute();
		
		// Force Auto Increments
		self::_forceAutoIncrements();
	}
	
	// _addAddon (#JFMTree)
	protected function _addAddon( $addon, $parent, $type )
	{
		$db		=	JFactory::getDbo();
		$exists	=	0;
		$name	=	str_replace( 'com_cck_', '', $addon->element );

		// -- Dirty workaround cleanup
		if ( $type == 'update' && version_compare( JFactory::getApplication()->cck_core_version_old, '3.11.4', '<' ) && $name != '' ) {
			$db->setQuery( 'DELETE FROM #__menu WHERE link = "index.php?option=com_cck_'.$name.'" AND client_id = 1 AND parent_id IN (0,1)' );
			$db->execute();
		} elseif ( $type == 'update' ) {
			$query	=	'SELECT id, parent_id FROM #__menu WHERE link = "index.php?option=com_cck_'.$name.'" AND client_id = 1 ORDER BY parent_id DESC';
			
			$db->setQuery( $query );
			
			$exists	=	$db->loadObjectList();
		}
		if ( is_array( $exists ) ) {
			if ( count( $exists ) > 1 ) {
				$db->setQuery( 'DELETE FROM #__menu WHERE link = "index.php?option=com_cck_'.$name.'" AND client_id = 1 AND id = '.$exists[0]->id );
				$db->execute();

				if ( isset( $exists[1] ) && $exists[1]->id ) {
					$exists	=	$exists[1]->id;
				} else {
					$exists	=	0;
				}
			} else {
				$exists	=	$exists[0]->id;
			}
		}
		if ( $exists ) {
			$table  =   JTable::getInstance( 'Menu' );
			$table->load( $exists );
			$table->setLocation( $parent->id, 'last-child' );
			$table->check();
			$table->store();
			$table->rebuildPath( $table->id );
		} else {
			$table	=	JTable::getInstance( 'Menu' );
			$data	=	array( 'menutype'=>'main', 'title'=>$addon->element.'_title', 'alias'=>$addon->title, 'path'=>'SEBLOD/'.$addon->title,
							   'link'=>'index.php?option=com_cck_'.$name, 'type'=>'component', 'published'=>1, 'parent_id'=>$parent->id,
							   'level'=>2, 'component_id'=>$addon->id, 'access'=>1, 'img'=>'class:component', 'client_id'=>1 );
			
			$table->setLocation( $data['parent_id'], 'last-child' );
			$table->bind( $data );
			$table->check();
			$table->alias	=	$addon->title;
			$table->path	=	'SEBLOD/'.$addon->title;
			$table->store();
			$table->rebuildPath( $table->id );
			$db->setQuery( 'UPDATE #__menu SET alias = "'.$addon->title.'", path = "SEBLOD/'.$addon->title.'" WHERE id = '.(int)$table->id. ' AND client_id = 1' );
			$db->execute();
		}
	}

	// _convertTablesToUtf8mb4
	protected function _convertTablesToUtf8mb4()
	{
		$app		=	JFactory::getApplication();
		$db			=	JFactory::getDbo();
		$name		=	$db->getName();
		$params		=	JComponentHelper::getParams( 'com_cck' );
		$status		=	(int)$params->get( 'utf8_conversion', '' );
		$utf8mb4	=	false;

		if ( stristr( $name, 'mysql' ) === false ) {
			return;
		}

		if ( !JCck::on( '3.5 ' ) ) {
		    return;
		}

		if ( $status > 0 ) {
		    return;
		}

		if ( JCck::on( '3.5' ) ) {
			$utf8mb4	=	$db->hasUTF8mb4Support();
		}

		$i			=	0;
		$prefix		=	JFactory::getConfig()->get( 'dbprefix' );
		$tables		=	$db->getTableList();

		if ( count( $tables ) ) {
		    foreach ( $tables as $name ) {
				$continue	=	false;
				$pos		=	strpos( $name, $prefix.'cck_' );

		        if ( !( $pos !== false && $pos == 0 ) ) {
					continue;
				}
				$columns	=	$db->getTableColumns( $name, false );

				if ( count( $columns ) ) {
					foreach ( $columns as $column ) {
					    if ( isset( $column->Collation ) && $column->Collation ) {
							$collations	=	explode( '_', $column->Collation );
							$charset	=	@$collations[0];

							// Convert only if utf8
							if ( $charset ) {
								$charset = strtolower( $charset );

								if ( $charset !== 'utf8' && $charset !== 'utf8mb4' ) {
									$continue	=	true;
									break;
								}
							}

							// Convert only if indexes allow it
							if ( isset( $column->Key ) && $column->Key ) {
								$type		=	'';

							    if ( isset( $column->Type ) && $column->Type ) {
									$type	=	$column->Type;
								}
							    if ( $type != '' ) {
									$types	=	explode( '(', $type );
									$type	=	@$types[1];
									
									if ( $type ) {
										$len	=	strlen( $type );

										if ( $type[$len - 1] == ')' ) {
											$type	=	substr( $type, 0, -1 );
										}
										if ( $type ) {
											if ( (int)$type > 191 ) {
												$continue	=	true;
												break;    
											}
										}
									}
								}
							}
						}
					}
				}
		        if ( $continue ) {
					$app->enqueueMessage( '<strong>'.$name.'</strong> not converted to utf8mb4. Please check this table manually.', 'error' );
					continue;
				}
				$query	=	'ALTER TABLE `'.$name.'` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';
				$query2	=	'ALTER TABLE `'.$name.'` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;';

		        if ( !$utf8mb4 ) {
					$query	=	$db->convertUtf8mb4QueryToUtf8( $query );
					$query2	=	$db->convertUtf8mb4QueryToUtf8( $query2 );
				}
				$db->setQuery( $query );
				$db->execute();
				$db->setQuery( $query2 );
				$db->execute();

				$i++;
			}
			$message	=	( $utf8mb4 ) ? 'utf8mb4_unicode_ci' : 'utf8_unicode_ci (as utf8mb4_unicode_ci is not supported)';
			$message	=	'<strong>'.$i.' tables</strong> converted to '.$message.'.';
			
			$app->enqueueMessage( $message );

			$params->set( 'utf8_conversion', ( $utf8mb4 ? '2' : '1' ) );
			$db->setQuery( 'UPDATE #__extensions SET params = "'.$db->escape( $params ).'" WHERE name = "com_cck"' );
			$db->execute();
		}
	}

	// _forceAutoIncrements
	protected function _forceAutoIncrements()
	{
		$tables =	array(
						'#__cck_core_fields'=>5000,
						'#__cck_core_folders'=>500,
						'#__cck_core_searchs'=>500,
						'#__cck_core_sites'=>500,
						'#__cck_core_templates'=>500,
						'#__cck_core_types'=>500,
						'#__cck_core_versions'=>500,
						'#__cck_more_jobs'=>500,
						'#__cck_more_processings'=>500,
						'#__cck_more_sessions'=>500
					);

		if ( count( $tables ) ) {
			foreach ( $tables as $name=>$auto_inc ) {
				$max	=	(int)JCckDatabase::loadResult( 'SELECT MAX(id) FROM '.$name );

				if ( $max < $auto_inc ) {
					// Add temp entry
					$table	=	JCckTable::getInstance( $name );

					if ( $table->load( $auto_inc, true ) ) {
						if ( property_exists( $table, 'published' ) ) {
							$table->published   =   -44;
							$table->store();
						}
					}
				} elseif ( $max > $auto_inc ) {
					// Remove temp entry (id = $auto_inc && published = -44 && title == '')
					$table	=	JCckTable::getInstance( $name );
					$table->load( $auto_inc );

					if ( is_object( $table ) && $table->id > 0 ) {
						if ( isset( $table->published ) && $table->published == -44 ) {
							if ( ( isset( $table->title ) && $table->title == '' )
							  || ( isset( $table->e_title ) && $table->e_title == '' ) ) {
								$table->delete( $auto_inc );
							}
						}
					}
				}
			}
		}
	}

	// _reorderPlugins
	protected function _reorderPlugins( $type )
	{
		$db		=	JFactory::getDbo();
		$i		=	2;
		$ids	=	array();
				
		$db->setQuery( 'SELECT extension_id FROM #__extensions WHERE type = "plugin" AND folder = "'.$type.'" AND element != "cck" ORDER BY ordering' );
		
		$items	=	$db->loadObjectList();
		
		$sql	=	'UPDATE #__extensions SET ordering = CASE extension_id';
		
		foreach ( $items as $item ) {
			$ids[]	=	$item->extension_id;
			$sql	.=	' WHEN '.$item->extension_id.' THEN '.$i++;
		}
		$sql	.=	' END WHERE extension_id IN ('.implode( ',', $ids ).')';
		
		$db->setQuery( $sql );
		$db->execute();			
		
		$db->setQuery( 'UPDATE #__extensions SET ordering = 1 WHERE type = "plugin" AND folder = "'.$type.'" AND element = "cck"' );
		$db->execute();
	}

	// _setUserActionsLog
	protected function _setUserActionsLog()
	{
		$db			=	JFactory::getDbo();
		$db_prefix	=	JFactory::getConfig()->get( 'dbprefix' );
		$table_name	=	$db_prefix.'action_logs_extensions';
		$tables		=	$db->getTableList();
		$tables		=	array_flip( $tables );

		if ( isset( $tables[$table_name] ) ) {
			$db->setQuery( 'SELECT COUNT(id) FROM `#__action_logs_extensions` WHERE extension = "com_cck"' );
			
			if ( (int)$db->loadResult() == 0 ) {
				$db->setQuery( 'INSERT IGNORE INTO `#__action_logs_extensions` (`extension`) VALUES ("com_cck")' );
				$db->execute();
			}
		}
	}

	// _setUtf8mb4
	protected function _setUtf8mb4( $params )
	{
		$db			=	JFactory::getDbo();
		$name		=	$db->getName();
		$status		=	(int)$params->get( 'utf8_conversion', '' );
		$utf8mb4	=	false;

		if ( stristr( $name, 'mysql' ) === false ) {
			return;
		}

		if ( !JCck::on( '3.5 ' ) ) {
		    return;
		}

		if ( $status > 0 ) {
		    return;
		}

		if ( JCck::on( '3.5' ) ) {
			$utf8mb4	=	$db->hasUTF8mb4Support();
		}

		$params->set( 'utf8_conversion', ( $utf8mb4 ? '2' : '1' ) );
		$db->setQuery( 'UPDATE #__extensions SET params = "'.$db->escape( $params ).'" WHERE name = "com_cck"' );
		$db->execute();
	}
}
?>