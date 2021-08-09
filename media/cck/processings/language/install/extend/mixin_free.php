<?php
defined( '_JEXEC' ) or die;

$mixin	=	new class() {
	// _getLanguageAssociations
	protected function _getLanguageAssociations()
	{
		return function() {
			$associations	=	array();
			$items			=	JLanguageAssociations::getAssociations( 'com_cck', '#__cck_store_form_o_element', 'com_cck.free.#__cck_store_form_o_element', $this->getPk(), 'id', '', '' );
								
			foreach ( $items as $lang_tag=>$item ) {
				$associations[$lang_tag]	=	$item->id;
			}

			return $associations;
		};
	}

	// _getTypes
	protected function _getTypes()
	{
		return function() {
			$query	=	'SELECT name AS value, REPLACE(SUBSTRING(title, 10),"]","") AS text'
					.	' FROM #__cck_core_types'
					.	' WHERE published = 1'
					.	' AND name LIKE "o_element_%"'
					.	' AND name NOT LIKE "%_grp%"'
					.	' ORDER BY text ASC'
					;

			return JCckDatabase::loadColumn( $query );
		};
	}

	// _loadLanguageAssociation
	protected function _loadLanguageAssociation()
	{
		return function( $lang_tag ) {
			$assoc_id		=	0;
			$associations	=	JLanguageAssociations::getAssociations( 'com_cck', '#__cck_store_form_o_element', 'com_cck.free.#__cck_store_form_o_element', $this->getPk(), 'id', '', '' );

			if ( isset( $associations[$lang_tag] ) ) {
				$assoc_id	=	(int)$associations[$lang_tag]->id;
			}

			if ( $assoc_id ) {
				$this->load( $assoc_id );
			}
		};
	}

	// _setLanguageAssociations
	protected function _storeLanguageAssociations()
	{
		return function( $associations ) {
			$context	=	'com_cck.free';

			if ( $this->getTable() ) {
				$context	.=	'.'.$this->getTable();
			} else {
				// error
			}

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