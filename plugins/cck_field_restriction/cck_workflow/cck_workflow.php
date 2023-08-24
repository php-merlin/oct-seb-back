<?php
/**
* @version 			SEBLOD 3.x Core
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// Plugin
class plgCCK_Field_RestrictionCck_Workflow extends JCckPluginRestriction
{
	protected static $type	=	'cck_workflow';
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare

	// onCCK_Field_RestrictionPrepareContent
	public static function onCCK_Field_RestrictionPrepareContent( &$field, &$config )
	{
		if ( self::$type != $field->restriction ) {
			return;
		}
		
		$restriction	=	parent::g_getRestriction( $field->restriction_options );
		
		return self::_authorise( $restriction, $field, $config );
	}

	// onCCK_Field_RestrictionPrepareForm
	public static function onCCK_Field_RestrictionPrepareForm( &$field, &$config )
	{
		if ( self::$type != $field->restriction ) {
			return;
		}
		
		$restriction	=	parent::g_getRestriction( $field->restriction_options );
		
		return self::_authorise( $restriction, $field, $config );
	}
	
	// onCCK_Field_RestrictionPrepareStore
	public static function onCCK_Field_RestrictionPrepareStore( &$field, &$config )
	{
		if ( self::$type != $field->restriction ) {
			return;
		}
		
		$restriction	=	parent::g_getRestriction( $field->restriction_options );
		
		return self::_authorise( $restriction, $field, $config );
	}
	
	// _authorise
	protected static function _authorise( $restriction, &$field, &$config )
	{
		$action		=	$restriction->get( 'action', '' );
		$author		=	$restriction->get( 'author', '' );
		$location	=	$restriction->get( 'location', '' );
		$type		=	$restriction->get( 'form', '' );
		$do			=	(int)$restriction->get( 'do', 0 );

		// Action
		if ( $action ) {
			if ( ( $action == 'add' && !$config['isNew'] )
			  || ( $action == 'edit' && $config['isNew'] ) ) {
			  	if ( !$do ) {
					$field->display	=	0;
					$field->state	=	0;
					return false;
				}
			} else {
				if ( $do ) {
					$field->display	=	0;
					$field->state	=	0;
					return false;					
				}
			}
		}

		// Author
		if ( $author ) {
			$user	=	JFactory::getUser();
			
			if ( ( $author  == '1' && $config['author'] != $user->id )
			  || ( $author  == '-1' && $config['author'] == $user->id ) ) {
				$field->display	=	0;
				$field->state	=	0;
				return false;
			}
		}
		
		// Content Type
		if ( $type ) {
			if ( strpos( $type, ',' ) !== false ) {
				$content_types	=	explode( ',', $type );
				$found	=	false;

				foreach ( $content_types as $content_type ) {
					if ( $config['type'] == $content_type ) {
						$found	=	true;
						break;
					}
				}
				if ( $found ) {
					if ( $do ) {
						$field->display	=	0;
						$field->state	=	0;
						return false;
					}
				} else {
					if ( !$do ) {
						$field->display	=	0;
						$field->state	=	0;
						return false;					
					}
				}
			} else {
				if ( $type != $config['type'] ) {
					if ( !$do ) {
						$field->display	=	0;
						$field->state	=	0;
						return false;					
					}
				} else {
					if ( $do ) {
						$field->display	=	0;
						$field->state	=	0;
						return false;					
					}
				}
			}
		}

		// Location
		if ( $location ) {
			if ( $location == 'admin' ) {
				$location	=	'administrator';
			}
			if ( !JFactory::getApplication()->isClient( $location ) ) {
				$field->display	=	0;
				$field->state	=	0;
				return false;
			}
		}

		// Variable
		$condition_field	=	$restriction->get( 'trigger' );
		$condition_match	=	$restriction->get( 'match' );
		$condition_values	=	$restriction->get( 'values' );
		$state				=	0;
		$variable			=	isset( $config['context'][$condition_field] ) ? $config['context'][$condition_field] : '';
		
		if ( $condition_field != '' ) {
			if ( $condition_match == 'isFilled' ) {
				if ( is_array( $variable ) ) {
					foreach ( $variable as $v ) {
						if ( $v != '' ) {
							$state	=	1;
							break;
						}
					}
				} elseif ( $variable != '' ) {
					$state		=	1;
				}
			} elseif ( $condition_match == 'isEqual' ) {
				if ( isset( $variable ) ) {
					$condition_values	=	explode( ',', $condition_values );
					if ( is_array( $variable ) ) {
						if ( count( array_intersect( $condition_values, $variable ) ) ) {
							$state		=	1;
						}
					} else {
						foreach ( $condition_values as $v ) {
							if ( $variable == $v ) {
								$state		=	1;
								break;
							}
						}
					}	
				}
			}

			if ( $state ) {
				$do		=	( $do ) ? false : true;
			} else {
				$do		=	( $do ) ? true : false;
			}

			if ( $do ) {
				return true;
			} else {
				$field->display	=	0;
				$field->state	=	0;
				return false;
			}
		}

		return true;
	}
}
?>