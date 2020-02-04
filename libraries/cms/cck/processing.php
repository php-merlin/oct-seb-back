<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: processing.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

use Joomla\Registry\Registry;

// JCckProcessing
class JCckProcessing
{
	protected static $apps		=	array();
	protected static $apps_map	=	array();

	protected $_event			=	null;
	protected $_options			=	null;
	protected $_path			=	null;

	protected $_data			=	array();
	protected $_type			=	'';

	// -------- -------- -------- -------- -------- -------- -------- -------- // Construct

	// __construct
	public function __construct( $event, $path, $options = array() )
	{
		$this->_event	=	$event;
		$this->_path	=	$path;
		$this->_options	=	new Registry( $options );
	}

	// execute
	public function execute( &$config, &$fields )
	{
		if ( !is_file( $this->_path ) ) {
			return;
		}

		// $args	=	func_get_args();

		$this->_data['config']	=	$config;
		$this->_data['fields']	=	$fields;

		$this->_type			=	$this->_data['config']['type'];

		$this->run( 'once' );

		$config	=	$this->_data['config'];
		$fields	=	$this->_data['fields'];

		unset( $this->_data );
	}

	// initialize
	public function initialize()
	{

	}

	// run
	public function run( $type = '' )
	{
		if ( $type == 'once' ) {
			include_once $this->_path;
		} else {
			include $this->_path;
		}
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Check

	// isNew
	public function isNew()
	{
		if ( isset( $this->_data['config']['isNew'] ) && $this->_data['config']['isNew'] ) {
			return true;
		}

		return false;
	}

	// isFirstItem
	// public function isFirstItem() {}

	// isLastItem
	// public function isLastItem() {}

	// isSecure
	public function isSecure()
	{
		if ( $this->_event ) {
			return true;
		}

		return false;
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Do

	// sendMail
	// public function sendMail() {}

	// setType
	public function setType( $content_type )
	{
		$this->_data['config']['type'] 	=	$content_type;
		
		JCckDatabase::execute( 'UPDATE #__cck_core SET cck="'.$content_type.'" WHERE id='.(int)$this->_data['config']['id'] );
	}

	// setValue
	public function setValue( $name, $value )
	{
		if ( isset( $this->_data['fields'][$name] ) ) {
			$this->_data['fields'][$name]->value	=	$value;

			$field	=	JCckDatabase::loadObject( 'SELECT storage, storage_table, storage_field, storage_field2 FROM #__cck_core_fields WHERE name = "'.$name.'"' );

			if ( is_object( $field ) && $field->storage_table && $field->storage_field ) {
				switch ( $field->storage ) {
					case 'standard':
						if ( isset( $this->_data['config']['storages'] ) ) {
							$this->_data['config']['storages'][$field->storage_table][$field->storage_field]	=	$value;
						}

						if ( strpos( $this->_event, 'afterStore' ) !== false && $this->_pk ) {
							JCckDatabase::execute( 'UPDATE '.$field->storage_table.' SET '.$field->storage_field.'= "'.$value.'" WHERE id = '.(int)$pk );
						}
						break;
					default:
						break;
				}
			}
		}
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Get

	// getApp
	public function getApp()
	{
		if ( !$this->_type ) {
			return (object)array( 'name'=>'' );
		}

		if ( !isset( self::$apps_map[$this->_type] ) ) {
			self::$apps_map[$this->_type]	=	JCckDatabase::loadResult( 'SELECT folder FROM #__cck_core_types WHERE name = "'.$this->_type.'"' );
		}
		if ( !isset( self::$apps[self::$apps_map[$this->_type]] ) ) {
			self::$apps[self::$apps_map[$this->_type]]			=	JCckDatabase::loadObject( 'SELECT name, params FROM #__cck_core_folders WHERE id = "'.self::$apps_map[$this->_type].'"' );
			self::$apps[self::$apps_map[$this->_type]]->params	=	new Registry( self::$apps[self::$apps_map[$this->_type]]->params );
		}

		return self::$apps[self::$apps_map[$this->_type]];
	}

	// getId
	public function getId()
	{
		if ( isset( $this->_data['config']['id'] ) ) {
			return (int)$this->_data['config']['id'];
		}

		return 0;
	}

	// getObject
	public function getObject()
	{
		if ( isset( $this->_data['config']['location'] ) ) {
			return $this->_data['config']['location'];
		}

		return '';
	}

	// getPk
	public function getPk()
	{
		if ( isset( $this->_data['config']['pk'] ) ) {
			return (int)$this->_data['config']['pk'];
		}

		return 0;
	}

	// getType
	public function getType()
	{
		return $this->_type;
	}

	// getValue
	public function getValue( $name )
	{
		if ( isset( $this->_data['fields'][$name] ) ) {
			return $this->_data['fields'][$name]->value;
		}

		return '';
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Trigger

	/*
	// trigger
	public function trigger( $event )
	{
		$path	=	JPATH_SITE.'/project/apps/'.$this->getApp()->name.'/trigger/'.$event.'/'.$this->getType().'.php';

		if ( is_file( $path ) ) {
			include_once $path;
		} else {
			$path	=	JPATH_SITE.'/project/apps/'.$this->getApp()->name.'/trigger/'.$event.'.php';

			if ( is_file( $path ) ) {
				include_once $path;
			}
		}
	}
	*/
}
?>