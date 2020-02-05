<?php
defined( '_JEXEC' ) or die;

$mixin	=	new class() {
	// _createNavItems
	protected function _createNavItems()
	{
		return function( $data_default, $src_pks, $params ) {
			$aliases	=	array();

			// Create
			foreach ( $src_pks as $src_pk=>$null ) {
				$src_pks[$src_pk]	=	0;

				if ( !$this->load( $src_pk )->isSuccessful() ) {
					continue;
				}

				$data	=	$this->getData();

				// Alias
				if ( $data['type'] == 'alias' ) {
					$aliases[$src_pk]	=	(int)$this->getRegistry( 'params' )->get( 'aliasoptions' );
				}

				// Association
				$this->_loadLanguageAssociation( 'en-GB', $params );

				$associations		=	$this->_getLanguageAssociations();

				if ( count( $associations ) ) {
					$associations['en-GB']	=	(string)$this->getPk();
				}

				$data['alias']		=	$this->getProperty( 'alias' );
				$data['title']		=	$this->getProperty( 'title' );

				foreach ( $data_default as $k=>$v ) {
					$data[$k]	=	$v;
				}

				// Home
				if ( $data['alias'] == 'home-en-gb' ) {
					$data['alias']	=	'home-'.strtolower( $data_default['language'] );
				}

				// Parent ID
				if ( $data['parent_id'] && $data['parent_id'] != '1' && isset( $src_pks[(int)$data['parent_id']] ) ) {
					$data['parent_id']	=	$src_pks[(int)$data['parent_id']];
				}

				unset( $data['lft'], $data['rgt'], $data['level'], $data['path'] );

				if ( !$this->create( 'menu_item', $data )->isSuccessful() ) {
					continue;
				}

				if ( count( $associations ) ) {
					$this->_storeLanguageAssociations( $associations );
				}

				$src_pks[$src_pk]	=	$this->getPk();
			}

			// Update Aliases
			foreach ( $aliases as $src_pk=>$alias_pk ) {
				if ( !isset( $src_pks[$src_pk], $src_pks[$alias_pk] ) ) {
					continue;
				}

				if ( !$this->load( $src_pks[$src_pk] )->isSuccessful() ) {
					continue;
				}

				$json	=	$this->getRegistry( 'params' );
				$json->set( 'aliasoptions', (string)$src_pks[$alias_pk] );

				$this->setProperty( 'params', $json->toString( 'JSON', array( 'bitmask'=>JSON_UNESCAPED_UNICODE ) ) )
					 ->store();
			}

			return $src_pks;
		};
	}

	// _getLanguageAssociationId
	protected function _getLanguageAssociationId()
	{
		return function( $lang_tag ) {
			$associations	=	$this->_getLanguageAssociations();

			if ( isset( $associations[$lang_tag] ) ) {
				return $associations[$lang_tag];
			}

			return 0;
		};
	}

	// _getLanguageAssociations
	protected function _getLanguageAssociations()
	{
		return function() {
			$associations	=	array();
			$items			=	JLanguageAssociations::getAssociations( 'com_menus', '#__menu', 'com_menus.item', $this->getPk(), 'id', '', '' );

			foreach ( $items as $lang_tag=>$item ) {
				$associations[$lang_tag]	=	$item->id;
			}

			return $associations;
		};
	}

	// _loadLanguageAssociation
	protected function _loadLanguageAssociation()
	{
		return function( $lang_tag, $params ) {
			$pk				=	$this->getPk();

			$assoc_id		=	0;
			$associations	=	JLanguageAssociations::getAssociations( 'com_menus', '#__menu', 'com_menus.item', $pk, 'id', '', '' );

			if ( isset( $associations[$lang_tag] ) ) {
				$assoc_id	=	(int)$associations[$lang_tag]->id;
			} elseif ( isset( $params['associations'][(string)$pk] ) ) {
				$assoc_id	=	(int)$params['associations'][(string)$pk];
			}

			if ( $assoc_id ) {
				$this->load( $assoc_id );
			} else {
				$this->_error	=	true;
			}
		};
	}

	// _setLanguageAssociations
	protected function _storeLanguageAssociations()
	{
		return function( $associations ) {
			$context	=	'com_menus.item';
			$lang_tag	=	$this->getProperty( 'language' );

			if ( $lang_tag == '*' ) {
				return false;
			}

			if ( !( is_array( $associations ) && count( $associations ) ) ) {
				return false;
			}
			
			foreach ( $associations as $tag=>$id ) {
				if ( empty( $id ) ) {
					unset( $associations[$tag] );
				}
			}
			
			$db							=	JFactory::getDbo();
			$associations[$lang_tag]	=	(string)$this->getPk();

			// Delete
			$query	=	$db->getQuery( true )
						   ->delete( '#__associations' )
						   ->where( 'context = ' . $db->quote( $context ) )
						   ->where( 'id IN (' . implode(',', $associations ) . ')' );

			$db->setQuery( $query );
			$db->execute();

			// Insert
			if ( count( $associations ) ) {
				$key	=	md5( json_encode( $associations ) );

				$query->clear()
					  ->insert( '#__associations' );

				foreach ( $associations as $tag=>$id ) {
					$query->values( $id . ',' . $db->quote( $context ) . ',' . $db->quote( $key ) );
				}

				$db->setQuery( $query );
				$db->execute();
			}
		};
	}
};
?>