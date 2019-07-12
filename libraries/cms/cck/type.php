<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: tpye.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

use Joomla\Registry\Registry;

// JCckType
class JCckType
{
	protected static $callables			=	array();
	protected static $callables_map		=	array();
	protected static $incognito			=	array(
												'__call'=>'',
												'__construct'=>'',
												'_setTypeByName'=>'',
												'_setCallable'=>'',
												'_setMixin'=>'',
											);

	protected $_options					=	null;

	protected $_callables				=	array();
	protected $_error					=	false;
	protected $_logs					=	array(); /* TODO#SEBLOD: reset? */
	protected $_name					=	'';
	protected $_object					=	'';

	// -------- -------- -------- -------- -------- -------- -------- -------- // Construct

	// __construct
	public function __construct()
	{
		$this->_options			=	new Registry;
	}

	// getInstance
	public static function getInstance( $identifier = '' )
	{
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Do

	// clear
	public function clear()
	{
		$this->_error	=	false;

		return $this;
	}

	// load (^)
	public function load( $identifier )
	{
		$this->reset();

		if ( !$this->_setTypeByName( $identifier ) ) {
			$this->_error	=	true;

			return $this;
		}
		/* TODO#SEBLOD4 */

		return $this;
	}

	// reset
	public function reset( $complete = false )
	{
		$this->clear();

		/* TODO#SEBLOD4 */

		if ( $complete ) {
			/* TODO#SEBLOD4 */
		}

		return $this;
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Get

	// getCallable
	public function getCallable()
	{
		$items		=	array();

		/* TODO#SEBLOD4 */

		return $items;
	}

	// getContentObject
	public function getContentObject()
	{
		if ( !is_file( JPATH_SITE.'/plugins/cck_storage_location/'.$this->_object.'/'.$this->_object.'.php' ) ) {
			return false;
		}

		require_once JPATH_SITE.'/plugins/cck_storage_location/'.$this->_object.'/'.$this->_object.'.php';

		$properties	=	array(
							'type_alias'
						);
		$properties	=	JCck::callFunc( 'plgCCK_Storage_Location'.$this->_object, 'getStaticProperties', $properties );

		return 'JCckContent'.$properties['type_alias'];
	}

	// getPk
	public function getPk()
	{
		return (int)$this->_pk;
	}

	// getLog
	public function getLog()
	{
		return $this->_logs;
	}

	// getName
	public function getName()
	{
		return $this->_name;
	}

	// getObject
	public function getObject()
	{
		return $this->_object;
	}

	// hasCallable
	public function hasCallable( $name )
	{
		$scope	=	self::$callables_map[$name];

		if ( $scope == 'global' ) {
			if ( !isset( self::$callables[$name] ) ) {
				return false;
			}
		} else {
			if ( !isset( $this->_callables[$name] ) ) {
				return false;
			}
		}

		return true;
	}

	// isSuccessful
	public function isSuccessful()
	{
		return $this->_error ? false : true;
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Manage Fields

	// assign
	public function assign( $field_name, $client, $params = array() )
	{
		$ordering	=	JCckDatabase::loadResult( 'SELECT MAX(ordering) FROM #__cck_core_type_field WHERE typeid = '.$this->getPk().' and client = "'.$client.'"' );
		$field_id	=	JCckDatabase::loadResult( 'SELECT id FROM #__cck_core_fields WHERE name = "'.$field_name.'"' );

		// if ( $field_id ) {
		// 	$db		=	JFactory::getDbo();
		// 	$query	=	$db->getQuery( true )

		// 	$query->insert( '#__cck_core_type_field' )
		// 		->columns()
		// 		  ->values( $id . ',' . $db->quote( $context ) . ',' . $db->quote( $key ) );
		// 	foreach ( $associations as $tag=>$id ) {
				
		// 	}
		// 	$db->setQuery( $query );
		// 	$db->execute();
		// }
		// echo $ordering;
		// $table		=	JCckTableBatch::getInstance( '#__cck_core_type_field' );
		// $table->load( 'typeid = 540 AND client = "content"' );
		// $table->dump();
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Misc

	// __call
	public function __call( $method, $parameters )
	{
		if ( !$this->hasCallable( $method ) ) {
			throw new BadMethodCallException( 'Method not found.' );
		}

		$scope	=	self::$callables_map[$method];

		if ( $scope == 'global' ) {
			$callable	=	self::$callables[$method];
		} else {
			$callable	=	$this->_callables[$method];
		}

		if ( $callable instanceof Closure ) {
			return call_user_func_array( $callable->bindTo( $this, static::class ), $parameters );
		}

		return call_user_func_array( $callable, $parameters );
	}

	// dump
	public function dump( $scope = 'this' )
	{
		if ( !function_exists( 'dump' ) ) {
			$this->log( 'notice', 'Function not found.' );

			return false;
		}

		if ( $scope == 'self' ) {
			/* TODO#SEBLOD4 */
		} elseif ( $scope == 'callable' ) {
			dump( $this->getCallable() );
		} elseif ( $scope == 'log' ) {
			dump( $this->getLog() );
		} else {
			dump( $this->_callables, 'callables' );
			dump( $this->_error, 'error' );
			dump( $this->_id, 'id' );
			dump( $this->_logs, 'logs' );
			dump( $this->_name, 'name' );
			dump( $this->_object, 'object' );
			dump( $this->_pk, 'pk' );

			/* TODO#SEBLOD4 */
		}

		return true;
	}

	// extend
	public function extend( $path, $scope = 'instance' )
	{
		if ( !is_file( $path ) ) {
			$this->_error	=	true;

			return $this;
		}

		ob_start();
		include $path;
		ob_get_clean();

		$this->_setMixin( $mixin, $scope );
	}

	// _setCallable
	protected function _setCallable( $name, $callable, $scope )
	{
		if ( $scope == 'global' ) {
			self::$callables[$name]		=	$callable;
		} else {
			$this->_callables[$name]	=	$callable;
		}

		self::$callables_map[$name]	=	$scope;
	}

	// _setMixin
	protected function _setMixin( $mixin, $scope )
	{
		$methods	=	(new ReflectionClass( $mixin ) )->getMethods( ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED );

		foreach ( $methods as $method ) {
			$method->setAccessible( true );

			$this->_setCallable( $method->name, $method->invoke( $mixin ), $scope );
		}
	}

	// _setTypeByName
	protected function _setTypeByName( $identifier )
	{
		$query	=	'SELECT a.id AS pk, a.storage_location AS storage_location'
				.	' FROM #__cck_core_types AS a'
				.	' WHERE a.name = "'.$identifier.'"';

		$core	=	JCckDatabase::loadObject( $query );

		/* TODO#SEBLOD4: join #__cck_core and get id */
		
		if ( !( is_object( $core ) && $core->pk ) ) {
			return false;
		}

		$this->_object	=	$core->storage_location;

		/* TODO#SEBLOD4 */

		$this->_id					=	0;
		$this->_pk					=	$core->pk;
		$this->_name				=	$identifier;

		/* TODO#SEBLOD4 */

		return true;
	}
}
?>