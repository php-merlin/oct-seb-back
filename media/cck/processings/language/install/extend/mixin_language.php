<?php
defined( '_JEXEC' ) or die;

$mixin	=	new class() {
	use JCckContentTraitMixin;

	// _createElements
	protected function _createElements()
	{
		return function() {
			$content_element	=	new JCckContentFree;
			$content_element->setTable( '#__cck_store_free_elements' );

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
				$src_pks		=	$content_element->search( $element_type, array( 'language'=>'ru-RU', 'published'=>'1' ) )
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

					if ( count( $associations ) ) {
						$associations['en-GB']	=	(string)$content_element->getPk();
					}

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

			$data['name']			=	substr( $data['name'], 0, -2 ).$this->_( 'lang_sef' );
			$data['title']			=	substr( $data['title'], 0, -2 ).strtoupper( $this->_( 'lang_sef' ) );

			if ( $data['type'] == 'group' ) {
				$data['extended']		=	$data['name'];
			} elseif ( $data['type'] == 'item_x' ) {
				$data['storage_field']	=	substr( $data['storage_field'], 0, -2 ).$this->_( 'lang_sef' );
			} else {
				$data['storage_field2']	=	$this->_( 'lang_tag' );
			}

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
		return function( $app_name ) {
			foreach ( $this->_getDef( $app_name, 'fields' ) as $name=>$null ) {
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

			foreach ( $this->_getDef( $app_name, 'types' ) as $name=>$null ) {
				if ( !$type->load( $name )->isSuccessful() ) {
					continue;
				}

				$data	=	$type->getData();
				$fields	=	$type->_getFields( 'admin' );

				$data['name']	=	substr( $data['name'], 0, -2 ).$this->_( 'lang_sef' );
				$data['title']	=	substr( $data['title'], 0, -2 ).strtoupper( $this->_( 'lang_sef' ) );

				unset( $data['asset_id'], $data['checked_out'], $data['checked_out_time'] );

				if ( !$type->create( 'o_type', $data )->isSuccessful() ) {
					continue;
				}

				$fields	=	$type->_changeFields( $fields, $this->_( 'lang_sef' ) );
				$res	=	$type->_setFields( $fields );
				
				$this->_createField( $name );
			}
		};
	}

	// _createNav
	protected function _createNav()
	{
		return function( $menu_type ) {
			if ( !$this->_( 'lang_tag' ) ) {
				return $this;
			}

			$content_menu	=	new JCckContentMenu;

			$content_menu->create( 'menu', array(
											'client_id'=>'0',
											'description'=>'The main menu for the site ('.$this->_( 'lang_tag' ).')',
											'menutype'=>$menu_type,
											'title'=>'Main Menu ('.$this->_( 'lang_tag' ).')'
										   )
								 );
		};
	}

	// _createNavItems
	protected function _createNavItems()
	{
		return function( $data_search, $menu_type, $params ) {
			if ( !$this->_( 'lang_tag' ) ) {
				return $this;
			}

			$content_menu_item	=	new JCckContentMenuItem;
			$content_menu_item->extend( __DIR__.'/mixin_menu_item.php' );

			$data_create		=	array(
										'language'=>$this->_( 'lang_tag' ),
										'menutype'=>$menu_type
									);

			$src_pks			=	$content_menu_item->search( 'menu_item', $data_search )
													  ->by( 'lft' )
													  ->findPks();
			$src_pks			=	array_flip( $src_pks );
			$src_pks			=	$content_menu_item->_createNavItems( $data_create, $src_pks, $params );

			return $src_pks;
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
		return function( $id ) {
			$assoc_id	=	'';

			$content_menu_item	=	new JCckContentMenuItem;
			$content_menu_item->extend( __DIR__.'/mixin_menu_item.php' );

			if ( $content_menu_item->load( $id )->isSuccessful() ) {
				return $content_menu_item->_getLanguageAssociationId( $this->_( 'lang_tag' ) );
			}


			return $assoc_id;
		};
	}

	// _updateApp
	protected function _updateApp()
	{
		return function( $app_name ) {
			if ( !$this->_( 'lang_tag' ) ) {
				return $this;
			}
			if ( !$app_name ) {
				return $this;
			}

			$this->_createFields( $app_name );

			$this->_createType( $app_name );

			// $this->_updateTypes( $app_name );
		};
	}

	// _updateApps
	protected function _updateApps()
	{
		return function() {
			$apps	=	JFolder::files( dirname( __DIR__ ).'/def', '\.json$' );

			foreach ( $apps as $app ) {
				$app	=	basename( $app, '.json' );

				$this->_updateApp( $app );
			}
		};
	}

	// _updateTypes
	protected function _updateTypes()
	{
		return function( $app_name ) {
			$type	=	new JCckType;
			
			$type->load( $app_name.'_grp_description' )
				 ->assign( $app_name.'_text_'.$this->_( 'lang_sef' ), 'content', array(
						 															'access'=>'1',
																					'label'=>'clear',
																					'markup'=>'none',
																					'position'=>'_main_',
																					'restriction'=>'joomla_language',
																					'restriction_options'=>'{"languages":"'.$this->_( 'lang_tag' ).'","do":"0"}'
																				) );

			$type->load( $app_name.'_grp_snippet' )
				 ->assign( $app_name.'_snippet_'.$this->_( 'lang_sef' ), 'content', array(
							 															'access'=>'1',
																						'label'=>'clear',
																						'markup'=>'none',
																						'position'=>'_main_',
																						'restriction'=>'joomla_language',
																						'restriction_options'=>'{"languages":"'.$this->_( 'lang_tag' ).'","do":"0"}'
																					) );

			$type->load( $app_name.'_grp_title' )
				 ->assign( $app_name.'_title_'.$this->_( 'lang_sef' ), 'content', array(
						 															'access'=>'1',
						 															'label'=>'clear',
																					'markup'=>'none',
																					'position'=>'_main_',
																					'restriction'=>'joomla_language',
																					'restriction_options'=>'{"languages":"'.$this->_( 'lang_tag' ).'","do":"0"}'
																				) )
				 ->assign( $app_name.'_title_'.$this->_( 'lang_sef' ), 'intro', array(
						 															'access'=>'1',
						 															'label'=>'clear',
						 															'link'=>'content',
						 															'link_options'=>'{"sef":"","itemid":"'.$this->_getNavItemAssociation( $this->_getDef( $app_name, 'menu_item' ) ).'","itemid_fieldname":"","content":"","content_fieldname":"","content_location":"joomla_article","language":"","itemid_mapping":"","attributes":"","class":"","target":"","target_params":"","rel":"","title":"","title_custom":"","state":"0","tmpl":"","custom":"","path_type":"0","site":""}',
																					'markup'=>'none',
																					'position'=>'_main_',
																					'restriction'=>'joomla_language',
																					'restriction_options'=>'{"languages":"'.$this->_( 'lang_tag' ).'","do":"0"}'
																				) );
		};
	}
};
?>