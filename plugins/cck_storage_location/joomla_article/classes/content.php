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

// JCckContent
class JCckContentJoomla_Article extends JCckContent
{
	// saveBase
	protected function saveBase()
	{
		if ( !$this->getId() ) {
			if ( property_exists( $this->_instance_base, 'language' ) && $this->_instance_base->language == '' ) {
				$this->_instance_base->language	=	'*';
			}
			if ( $this->_instance_base->state == 1 && (int)$this->_instance_base->publish_up == 0 ) {
				$this->_instance_base->publish_up	=	substr( JFactory::getDate()->toSql(), 0, -3 );
			}
		}

		$status			=	$this->_instance_base->store();

		if ( !$this->_pk && !$status ) {
			$i			=	2;
			$alias		=	$this->_instance_base->alias.'-'.$i;
			$property	=	self::$objects[$this->_object]['properties']['parent'];
			$test		=	JTable::getInstance( 'Content' );
			
			while ( $test->load( array( 'alias'=>$alias, $property=>$this->_instance_base->$property ) ) ) {
				$alias	=	$this->_instance_base->alias.'-'.$i++;
			}
			$this->_instance_base->alias	=	$alias;

			$status		=	$this->_instance_base->store();
		}

		return $status;
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Misc

	// _tag
	protected function _tag( $tags )
	{
		if ( !$this->_pk ) {
			return false;
		}
		if ( !$this->can( 'save' ) ) {
			$this->log( 'error', 'Permissions denied.' );

			return false;
		}

		if ( !is_array( $tags ) ) {
			$tags	=	array( $tags );
		}
		foreach ( $tags as $k=>$v ) {
			$tags[$k]	=	(string)$v;
		}

		$this->_instance_base->newTags	=	$tags;

		return $this->_instance_base->store();
	}

	// _untag
	protected function _untag( $tags )
	{
		if ( !$this->_pk ) {
			return false;
		}
		if ( !$this->can( 'save' ) ) {
			$this->log( 'error', 'Permissions denied.' );

			return false;
		}

		if ( !is_array( $tags ) ) {
			$tags	=	array( $tags );
		}
		foreach ( $tags as $k=>$v ) {
			$tags[$k]	=	(string)$v;
		}

		$tagHelper				=	new JHelperTags;
		$tagHelper->typeAlias	=	'com_content.article';
		$tagHelper->unTagItem( 0, $this->_instance_base, $tags );
	}
}
?>