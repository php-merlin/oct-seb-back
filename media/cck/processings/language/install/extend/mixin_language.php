<?php
defined( '_JEXEC' ) or die;

$mixin	=	new class() {
	use JCckContentTraitMixin;

	// _swapFieldProperty
	protected function _swapFieldProperty()
	{
		return function( $str, $mode = '' ) {
			if ( $str ) {
				$lang_sef	=	'en';
				
				if ( $mode == 'name' ) {
					if ( strpos( $str, '_'.$lang_sef ) === ( strlen( $str ) - 3 ) ) {
						$str	=	substr( $str, 0, -2 ).$this->_( 'lang_sef' );
					} else {
						$str	=	str_replace( '_en_', '_'.$this->_( 'lang_sef' ).'_', $str );	
					}
				} elseif ( $mode == 'title' ) {
					if ( strpos( $str, ' '.strtoupper( $lang_sef ) ) === ( strlen( $str ) - 3 ) ) {
						$str	=	substr( $str, 0, -2 ).strtoupper( $this->_( 'lang_sef' ) );
					} else {
						$str	=	str_replace( ' EN ', ' '.strtoupper( $this->_( 'lang_sef' ) ).' ', $str );
					}
				} else {
					if ( strpos( $str, '_'.$lang_sef ) === ( strlen( $str ) - 3 ) ) {
						$str	=	substr( $str, 0, -2 ).$this->_( 'lang_sef' );
					}	
				}
			}

			return $str;
		};
	}

	// _createAppFields
	protected function _createAppFields()
	{
		return function( $app_name ) {
			foreach ( $this->_getDef( $app_name, 'fields' ) as $name=>$null ) {
				$this->_createField( $name );
			}
		};
	}

	// _createElements
	protected function _createElements()
	{
		return function() {
			$content_element	=	new JCckContentFree;
			$content_element->setTable( '#__cck_store_form_o_element' );

			$content_element->extend( __DIR__.'/mixin_free.php' );

			$element_types		=	$content_element->_getTypes();

			$properties			=	array(
										'button_text',
										'headline_text',
										'image_alt_text',
										'logo_alt_text',
										'panel_text',
										'text_singleline_input',
										'text_paragraph_input'
									);

			foreach ( $element_types as $element_type ) {
				$src_pks		=	$content_element->search( $element_type, array( 'language'=>'en-GB', 'published'=>'1' ) )
													->findPks();
				$src_pks		=	array_flip( $src_pks );
				
				// Create
				foreach ( $src_pks as $src_pk=>$null ) {
					$src_pks[$src_pk]	=	0;

					if ( !$content_element->load( $src_pk )->isSuccessful() ) {
						continue;
					}

					$data			=	$content_element->getData();

					// Association
					$content_element->_loadLanguageAssociation( 'en-GB' );

					$associations	=	$content_element->_getLanguageAssociations();

					if ( !is_array( $associations ) ) {
						$associations	=	array();
					}

					$associations['en-GB']	=	(string)$content_element->getPk();

					$data['language']	=	$this->_( 'lang_tag' );
					$data['params']		=	json_decode( $data['params'], true );

					$json			=	$content_element->getRegistry( 'params' );

					foreach ( $properties as $property ) {
						if ( !isset( $data['params'][$property] ) ) {
							continue;
						}
						
						$data['params'][$property]	=	$json->get( $property, '' );
					}

					$data['params']		=	json_encode( $data['params'], JSON_UNESCAPED_UNICODE );

					if ( !$content_element->create( $element_type, $data )->isSuccessful() ) {
						continue;
					}

					if ( count( $associations ) ) {
						$content_element->_storeLanguageAssociations( $associations );
					}

					$src_pks[$src_pk]	=	$content_element->getPk();
				}
			}
		};
	}

	// _createField
	protected function _createField()
	{
		return function( $name ) {
			$field	=	new JCckField2;

			if ( !$field->load( $name )->isSuccessful() ) {
				return false;
			}

			$data	=	$field->getData();

			if ( !( $data['language'] && $data['language'] != '*' ) ) {
				return false;
			}

			$lang_tag	=	'en-GB';
			$lang_sef	=	'en';
			
			// Data
			if ( $data['storage'] && $data['storage'] != 'none' ) {
				$data['storage_field']	=	$this->_swapFieldProperty( $data['storage_field'] );

				if ( $data['storage_field2'] == $lang_tag ) {
					$data['storage_field2']	=	$this->_( 'lang_tag' );
				}
			}

			$data['extended']	=	$this->_swapFieldProperty( $data['extended'] );
			$data['language']	=	$this->_( 'lang_tag' );
			$data['name']		=	$this->_swapFieldProperty( $data['name'], 'name' );
			$data['title']		=	$this->_swapFieldProperty( $data['title'], 'title' );

			$parts				=	explode( '||', $data['location'] );

			foreach ( $parts as $replace ) {
				if ( !$replace ) {
					continue;
				}

				$search				=	$replace;
				$replace			=	$this->_swapFieldProperty( $replace );

				if ( $search != $replace ) {
					$data['location']	=	str_replace( $search, $replace, $data['location'] );
				}
			}

			// --
			switch ( $data['name'] ) {
				case 'o_freetext_translate_to_'.$this->_( 'lang_sef' ):
					$data['defaultvalue']	=	'J(Translate to '.str_replace( '-', '_', $this->_( 'lang_tag' ) ).')';
					break;
				case 'o_tab_languages_'.$this->_( 'lang_sef' ):
					$data['label']			=	str_replace( '-', '_', $this->_( 'lang_tag' ) );
					break;
				default:
					break;
			}
			// --

			unset( $data['checked_out'], $data['checked_out_time'] );

			if ( !$field->create( 'o_field', $data )->isSuccessful() ) {
				return false;
			}

			return true;
		};
	}

	// _createFields
	protected function _createFields()
	{
		return function() {
			$field_names	=	JCckDatabase::loadColumn( 'SELECT name FROM #__cck_core_fields WHERE language = "en-GB"' );

			foreach ( $field_names as $name ) {
				$this->_createField( $name );
			}
		};
	}

	// _createType
	protected function _createType()
	{
		return function( $app_name ) {
			$type	=	new JCckType;
			$type->extend( __DIR__.'/mixin_type.php' );

			// $content_types	=	$this->_getDef( $app_name, 'types' );

			// $content_types	=	array();
			// $content_types[$app_name.'_grp_form_'.$this->_( 'lang_sef' )]	=	true;

			// $name	=	$app_name.'_grp_form_en';
// dump($name);
			// foreach ( $content_types as $name=>$null ) {
				if ( !$type->load( $app_name )->isSuccessful() ) {
					return;
				}

				$data	=	$type->getData();
				$fields	=	$type->_getFields( 'admin' );

				// Data
				$data['name']		=	$this->_swapFieldProperty( $data['name'], 'name' );
				$data['title']		=	$this->_swapFieldProperty( $data['title'], 'title' );
				$data['language']	=	$this->_( 'lang_tag' );

				unset( $data['asset_id'], $data['checked_out'], $data['checked_out_time'] );

				if ( !$type->create( 'o_type', $data )->isSuccessful() ) {
					return;
				}

				// Alter Fields
				foreach ( $fields as $key=>$field ) {
					if ( $field->required != '' && strpos( $field->required, 'required[cond:' ) !== false ) {
						$field->required	=	str_replace( array( 'required[cond:', ']' ), '', $field->required );
						$field->required	=	'required[cond:'.$this->_swapFieldProperty( $field->required, 'name' ).']';
					}
					if ( $field->conditional != '' ) {
						$parts	=	explode( ',', $field->conditional );

						foreach ( $parts as $k=>$v ) {
							if ( strpos( $v, 'o_' ) !== false ) {
								$parts[$k]	=	$this->_swapFieldProperty( $v, 'name' );
							}
						}

						$fields[$key]->conditional	=	implode( ',', $parts );

						if ( $field->conditional_options != '' ) {
							$parts	=	explode( '"', $field->conditional_options );

							foreach ( $parts as $k=>$v ) {
								if ( strpos( $v, 'o_' ) !== false ) {
									$parts[$k]	=	$this->_swapFieldProperty( $v, 'name' );
								}
							}

							$fields[$key]->conditional_options	=	implode( '"', $parts );
						}
					}
				}
				
				// Update Fields
				$fields	=	$type->_changeFields( $fields, $this );

				$type->_setFields( $fields );

				// $this->_createField( $name );
			// }
		};
	}

	// _createNavItems
	protected function _createNavItems()
	{
		return function( $data_search, $menu_type ) {
			if ( !$this->_( 'lang_tag' ) ) {
				return $this;
			}

			$content_menu_item	=	new JCckContentMenuItem;
			$content_menu_item->extend( __DIR__.'/mixin_menu_item.php' );

			$data_create		=	array(
										'language'=>$this->_( 'lang_tag' ),
										'menutype'=>$menu_type
									);

			$src_pks			=	$content_menu_item->search( 'o_nav_item', $data_search )
													  ->by( 'lft' )
													  ->findPks();
			$src_pks			=	array_flip( $src_pks );
			$src_pks			=	$content_menu_item->_createNavItems( $data_create, $src_pks );

			return $src_pks;
		};
	}

	// _parseNavLists
	protected function _parseNavLists()
	{
		return function() {
			if ( !$this->_( 'lang_tag' ) ) {
				return $this;
			}

			$content_menu	=	new JCckContentMenu;

			foreach ( $content_menu->find( 'o_nav_list' )->getPks() as $pk ) {
				$content_menu->load( $pk );

				if ( !$content_menu->isSuccessful() ) {
					continue;
				}

				$nav_list	=	$content_menu->getProperty( 'menutype' );
				$nav_list2	=	$nav_list;

				if ( strpos( $nav_list, 'en-gb' ) !== false ) {
					$data	=	$content_menu->getData();

					unset( $data['asset_id'] );

					$data['description']	=	str_replace( 'en-GB', $this->_( 'lang_tag' ), $data['description'] );
					$data['title']			=	str_replace( 'en-GB', $this->_( 'lang_tag' ), $data['title'] );
					$data['menutype']		=	str_replace( 'en-gb', strtolower( $this->_( 'lang_tag' ) ), $data['menutype'] );

					$content_menu->create( 'o_nav_list', $data );

					if ( !$content_menu->isSuccessful() ) {
						continue;
					}

					$nav_list2	=	$data['menutype'];
				}
				if ( $content_menu->isSuccessful() ) {
					$this->_createNavItems( array( 'language'=>'en-GB', 'menutype'=>$nav_list ), $nav_list2 );
				}
			}
		};
	}

	// _getDef
	public function _getDef()
	{
		static $def	=	array();

		return function( $app, $target ) use ( &$def ) {
			if ( !$app ) {
				return array();
			}

			if ( !isset( $def[$app] ) ) {
				$def[$app]	=	array();
				$path		=	dirname( __DIR__, 1 ).'/def/'.$app.'.json';

				if ( is_file( $path ) ) {
					$buffer	=	file_get_contents( $path );

					if ( $buffer ) {
						$def[$app]	=	json_decode( $buffer, true );
					}
				}
			}

			return isset( $def[$app][$target] ) ? $def[$app][$target] : array();
		};
	}

	// _getNavItemAssociation
	protected function _getNavItemAssociation()
	{
		return function( $id, $force = false ) {
			$assoc_id	=	0;

			$content_menu_item	=	new JCckContentMenuItem;
			$content_menu_item->extend( __DIR__.'/mixin_menu_item.php' );

			if ( $content_menu_item->load( $id )->isSuccessful() ) {
				$assoc_id	=	$content_menu_item->_getLanguageAssociationId( $this->_( 'lang_tag' ), array( 'c.language = ' . JCckDatabase::quote( 'en-GB' ) ) );
			}

			return ( $force && !$assoc_id ) ? $id : $assoc_id;
		};
	}

	// _updateApp
	protected function _updateApp()
	{
		return function( $app_name, $app_id ) {
			if ( !$this->_( 'lang_tag' ) ) {
				return $this;
			}
			if ( !$app_name ) {
				return $this;
			}

			$types	=	JCckDatabase::loadObjectList( 'SELECT id, name, language, parent FROM #__cck_core_types WHERE folder = '.(int)$app_id );
			// $this->_createAppFields( $app_name );

			foreach ( $types as $type ) {
				if ( !$type->parent ) {
					// OK
				} else {
					if ( $type->language == '*' ) {
						$this->_updateType( $type->name );
					} elseif ( $type->language == 'en-GB' ) {
						$this->_createType( $type->name );
					}
				}
			}
		};
	}

	// _updateApps
	protected function _updateApps()
	{
		return function() {
			// $apps	=	JFolder::files( dirname( __DIR__ ).'/def', '\.json$' );
			$apps	=	JCckDatabase::loadObjectList( 'SELECT id, name FROM #__cck_core_folders WHERE featured = 1' );

			foreach ( $apps as $app ) {
				// $app	=	basename( $app, '.json' );

				$this->_updateApp( $app->name, $app->id );
			}
		};
	}

	// _updateType
	protected function _updateType()
	{
		return function( $app_name ) {
			$type	=	new JCckType;
			$type->extend( __DIR__.'/mixin_type.php' );

// $app_name.'_grp_content_title'

			if ( $type->load( $app_name )->isSuccessful() ) {
				// Content
				$fields	=	$type->_getFields( 'content' );

				if ( count( $fields ) ) {
					$fields	=	$type->_parseFields( $fields, 'en-GB' );

					foreach ( $fields as $field ) {
						$name	=	$type->_getFieldName( $field->fieldid );
						$name	=	$this->_swapFieldProperty( $name, 'name' );

						unset( $field->client, $field->fieldid, $field->ordering, $field->typeid );

						$properties	=	(array)$field;

						$properties['restriction_options']	=	'{"languages":"'.$this->_( 'lang_tag' ).'","do":"0"}';

						$type->assign( $name, 'content', $properties );
					}	
				}

				// Intro
				$fields	=	$type->_getFields( 'intro' );

				if ( count( $fields ) ) {
					$fields	=	$type->_parseFields( $fields, 'en-GB' );

					foreach ( $fields as $field ) {
						$name	=	$type->_getFieldName( $field->fieldid );
						$name	=	$this->_swapFieldProperty( $name, 'name' );

						unset( $field->client, $field->fieldid, $field->ordering, $field->typeid );

						$properties	=	(array)$field;

						if ( $properties['link'] == 'content' ) {
							$properties['link_options']				=	json_decode( $properties['link_options'], true );
							$properties['link_options']['itemid']	=	$this->_getNavItemAssociation( $properties['link_options']['itemid'], true );
							$properties['link_options']				=	json_encode( $properties['link_options'] );
						}

						$properties['restriction_options']	=	'{"languages":"'.$this->_( 'lang_tag' ).'","do":"0"}';

						$type->assign( $name, 'intro', $properties );
					}
				}
			}
		};
	}
};
?>