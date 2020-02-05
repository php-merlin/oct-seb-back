<?php
defined( '_JEXEC' ) or die;

$mixin	=	new class() {
	// _changeFields
	public function _changeFields()
	{
		return function( $fields, $lang_sef ) {
			$ids	=	array();

			foreach ( $fields as $field ) {
				$ids[]	=	$field->fieldid;
			}
			$names	=	JCckDatabase::loadObjectList( 'SELECT id, name FROM #__cck_core_fields WHERE id IN ('.implode( ',', $ids ).')', 'id' );

			foreach ( $fields as $field ) {
				if ( isset( $names[$field->fieldid] ) ) {
					$id	=	$this->_getFieldAssociation( $names[$field->fieldid]->name, $lang_sef );

					if ( $id ) {
						$field->fieldid	=	$id;
					}
				}
			}

			return $fields;
		};
	}

	// _getFieldAssociation
	protected function _getFieldAssociation()
	{
		return function( $name, $lang_sef ) {
			$pos	=	strpos( $name, 'tab_ru' );

			if ( $pos === 0 ) {
				$name	=	'tab_'.$lang_sef.substr( $name, 6 );
			} else {
				$name	=	substr( $name, 0, -2 ).$lang_sef;
			}
			
			$assoc_id	=	(int)JCckDatabase::loadResult( 'SELECT id FROM #__cck_core_fields WHERE name = "'.$name.'"' );
			
			return (string)$assoc_id;
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