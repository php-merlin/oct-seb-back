<?php
defined( '_JEXEC' ) or die;

$mixin	=	new class() {
	// _changeFields
	public function _changeFields()
	{
		return function( $fields, $content_instance ) {
			$ids	=	array();

			foreach ( $fields as $field ) {
				$ids[]	=	$field->fieldid;
			}
			$names	=	JCckDatabase::loadObjectList( 'SELECT id, name FROM #__cck_core_fields WHERE id IN ('.implode( ',', $ids ).')', 'id' );

			foreach ( $fields as $field ) {
				if ( isset( $names[$field->fieldid] ) ) {
					$name	=	$content_instance->_swapFieldProperty( $names[$field->fieldid]->name, 'name' );
					$id		=	(string)$this->_getFieldId( $name );

					if ( $id ) {
						$field->fieldid	=	$id;
					}
				}
			}

			return $fields;
		};
	}

	// _getFieldId
	protected function _getFieldId()
	{
		return function( $name ) {			
			return (int)JCckDatabase::loadResult( 'SELECT id FROM #__cck_core_fields WHERE name = "'.$name.'"' );
		};
	}

	// _getFieldName
	protected function _getFieldName()
	{
		return function( $id ) {
			return JCckDatabase::loadResult( 'SELECT name FROM #__cck_core_fields WHERE id = '.(int)$id );
		};
	}

	// _getFields
	public function _getFields()
	{
		return function( $client ) {
			$table	=	JCckTableBatch::getInstance( '#__cck_core_type_field' );

			$table->load( 'typeid = '.$this->getPk().' AND client = "'.$client.'"' );

			return $table->getRows();
		};
	}

	// _parseFields
	public function _parseFields()
	{
		return function( $fields, $lang_tag ) {
			$items	=	array();

			foreach ( $fields as $field ) {
				$items[]	=	$field->fieldid;
			}

			if ( count( $items ) ) {
				$items	=	JCckDatabase::loadObjectList( 'SELECT id, language FROM #__cck_core_fields WHERE language = "'.$lang_tag.'" AND id IN ('.implode( ',', $items ).')', 'id' );
			}

			foreach ( $fields as $k=>$field ) {
				if ( !isset( $items[$field->fieldid] ) ) {
					unset( $fields[$k] );
				}
			}

			return $fields;
		};
	}

	// _setFields
	public function _setFields()
	{
		return function( $fields ) {
			$table	=	JCckTableBatch::getInstance( '#__cck_core_type_field' );

			$table->bind( $fields );
			$table->check( array(
							'typeid'=>(string)$this->getPk()
						   ) );

			return $table->store();
		};
	}
};
?>