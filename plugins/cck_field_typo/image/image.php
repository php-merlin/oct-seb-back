<?php
/**
* @version 			SEBLOD 3.x Core
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				http://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2013 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// Plugin
class plgCCK_Field_TypoImage extends JCckPluginTypo
{
	protected static $type			=	'image';
	protected static $thumb_count	=	6;
	protected static $path;
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
		
	// onCCK_Field_TypoPrepareContent
	public function onCCK_Field_TypoPrepareContent( &$field, $target = 'value', &$config = array() )
	{
		if ( self::$type != $field->typo ) {
			return;
		}
		self::$path	=	JURI::root().'plugins/cck_field_typo/'.self::$type.'/';
		
		// Prepare
		if ( $field->value && $field->value != '' ) {
			$typo	=	parent::g_getTypo( $field->typo_options );
			$field->typo	=	self::_typo( $typo, $field, '', $config );
		} else {
			$field->typo	=	'';
		}
	}
		
	// _typo
	protected static function _typo( $typo, &$field, $value, &$config = array() )
	{
		// Prepare
		$root			=	$typo->get( 'path_type', 0 ) ? JURI::root() : '';
		$thumb_array	=	array( 'thumb'=>$typo->get( 'thumb', 'thumb1' ),
								   'thumb_2x'=>$typo->get( 'thumb_2x', '' ),
								   'thumb_3x'=>$typo->get( 'thumb_3x', '' ),
								   'thumb_custom'=>$typo->get( 'thumb_custom', 0 ),
								   'thumb_width'=>$typo->get( 'thumb_width', '' ),
								   'thumb_height'=>$typo->get( 'thumb_height', '' ),
								   'image'=>$typo->get( 'image', 'value' ),
								   'image_custom'=>$typo->get( 'image_custom', 0 ),
								   'image_width'=>$typo->get( 'image_width', '' ),
								   'image_height'=>$typo->get( 'image_height', '' ),
								   'image_title'=>$typo->get( 'image_title', 1 )
								);
		$alt_fieldname	= 	$typo->get( 'image_alt_fieldname', '' );

		if ( is_array( $field->value ) ) {
			$typo	=	self::_addImages( $field, $thumb_array, $root );
		} else {
			$typo	=	self::_addImage( $field, $thumb_array, $root );
		}
		if ( $alt_fieldname != '' ) {
			parent::g_addProcess( 'beforeRenderContent', self::$type, $config, array( 'name'=>$field->name, 'alt_fieldname'=>$alt_fieldname  ) );
		}
		
		return $typo;
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Special Events
	
	// onCCK_Field_TypoBeforeRenderContent
	public static function onCCK_Field_TypoBeforeRenderContent( $process, &$fields, &$storages, &$config = array() )
	{
		if ( $fields[$process['alt_fieldname']] ) {
			if ( is_array( $fields[$process['name']]->value ) ) {
				foreach ( $fields[$process['name']]->value as $k=>$field ) {
					if ( isset( $field->image_alt ) && $field->image_alt ) {
						$search 						= 	'alt="'.$field->image_alt.'"';
						$replace						=	'alt="'.htmlspecialchars( $fields[$process['alt_fieldname']]->value ).'"';
						$fields[$process['name']]->typo	=	str_replace( $search, $replace, $fields[$process['name']]->typo );	
					}
					if ( isset( $field->image_title ) && $field->image_title ) {
						$search 						= 	'title="'.$field->image_title.'"';
						$replace						=	'title="'.htmlspecialchars( $fields[$process['alt_fieldname']]->value ).'"';
						$fields[$process['name']]->typo	=	str_replace( $search, $replace, $fields[$process['name']]->typo );
					}
				}
			} else {
				if ( isset( $fields[$process['name']]->image_alt ) && $fields[$process['name']]->image_alt ) {
					$search 						= 	'alt="'.$fields[$process['name']]->image_alt.'"';
					$replace						=	'alt="'.htmlspecialchars( $fields[$process['alt_fieldname']]->value ).'"';
					$fields[$process['name']]->typo	=	str_replace( $search, $replace, $fields[$process['name']]->typo );	
				}
				if ( isset( $fields[$process['name']]->image_title ) && $fields[$process['name']]->image_title ) {
					$search 						= 	'title="'.$fields[$process['name']]->image_title.'"';
					$replace						=	'title="'.htmlspecialchars( $fields[$process['alt_fieldname']]->value ).'"';
					$fields[$process['name']]->typo	=	str_replace( $search, $replace, $fields[$process['name']]->typo );
				}
			}
		}
	}

	// _addImage
	protected static function _addImage( &$field, $params, $root )
	{
		$value				=	$field->value;
		
		$ext				=	substr( strrchr( $field->value, "." ), 1 );
		$filename			=	substr( strrchr( $field->value, "/" ), 1 );
		$filename			=	str_replace('.'.$ext,'',$filename);
		
		$image_title		=	( isset( $field->image_title ) ) ? $field->image_title : '';
		$field->image_title	=	( $image_title != '' ) ? $image_title : $filename;
		$image_alt			=	( isset( $field->image_alt ) ) ? $field->image_alt : '';
		$field->image_alt	=	( $image_alt != '' ) ? $image_alt : $image_title;
		$field->image_title	=	( $params['image_title'] && $field->image_title ) ? $field->image_title : '';
		$attr_title			=	( $field->image_title ) ? 'title="'.$field->image_title.'" ' : '';

		$height				=	'';
		$srcset				=	'';
		$width				=	'';
		if ( $params['thumb_custom'] == 1 ) {
			$width	=	' width="'.$params['thumb_width'].'"';
			$height	=	' height="'.$params['thumb_height'].'"';
		}
		if ( $params['thumb_2x'] ) {
			$srcset	=	self::_availableThumb( $field, $params['thumb_2x'], $root ).' 2x';
			if ( $params['thumb_3x'] ) {
				$srcset	.=	', '.self::_availableThumb( $field, $params['thumb_3x'], $root ).' 3x';
			}
			$srcset	=	' srcset="'.$srcset.'"';
		}
		$img		=	'<img '.$attr_title.'alt="'.$field->image_alt.'" src="'.self::_availableThumb( $field, $params['thumb'], $root ).'"'.$srcset.$width.$height.' />';

		if ( isset( $field->link ) && $field->link ) {
			$typo	=	parent::g_hasLink( $field, new stdClass, $img );
		} elseif ( $params['image'] == 'none' ) {
			$typo	=	$img;
		} else {
			$typo	=	'<a id="colorBox'.$field->id.'" href="'.self::_availableValue( $field, $params['image'], $root ).'" rel="colorBox'.$field->id.'" title="'.$field->image_alt.'">'.$img.'</a>';
		}
		if ( $params['image'] != 'none' ) {
			self::_addScripts( array( 'id'=>$field->id ), $params );
		}
		
		return $typo;
	}

	// _addImages
	protected static function _addImages( &$field, $params, $root )
	{
		// Prepare
		$value	=	$field->value;
		$typo	=	'';
		
		foreach ( $field->value as $value_img ) {
			$typo	.=	self::_addImage( $value_img, $params, $root );
		}
		
		return $typo;
	}

	// _addScripts
	protected static function _addScripts( $params, $options )
	{
		$doc		=	JFactory::getDocument();
		$height		=	'';
		$width		=	'';
		
		if ( $options['image_custom'] > 0 ) {
			$dim	=	array( 'w'=>array( 1=>'width', 2=>'innerWidth', 3=>'maxWidth' ), 'h'=>array( 1=>'height', 2=>'innerHeight', 3=>'maxHeight' ) );
			$width	=	$dim['w'][$options['image_custom']].':'.$options['image_width'];
			$height	=	', '.$dim['h'][$options['image_custom']].':'.$options['image_height'];
		}
		$options	=	'{'.$width.$height.'}';
		
		JCck::loadjQuery();
		JCck::loadModalBox();
		if ( $params['id'] ) {
			$js	=	'jQuery(document).ready(function($){ $("a[rel=\'colorBox'.$params['id'].'\']").colorbox('.$options.'); });';
			$doc->addScriptDeclaration( $js );
		}
	}

	// _availableThumb
	protected static function _availableThumb( $field, $thumb, $root )
	{
		if ( isset( $field->$thumb ) && $field->$thumb ) {
			return $root.$field->$thumb;
		} else {
			for ( $i = 1; $i < self::$thumb_count; $i++ ) {
				if ( isset( $field->{'thumb'.$i} ) && $field->{'thumb'.$i} ) {
					return $root.$field->{'thumb'.$i};
				}
			}
			if ( isset( $field->value ) && $field->value ) {
				return $root.$field->value;
			}		
		}
	}

	// _availableValue
	protected static function _availableValue( $field, $thumb, $root )
	{
		if ( isset( $field->$thumb ) && $field->$thumb ) {
			return $root.$field->$thumb;
		} else {
			if ( isset( $field->value ) && $field->value ) {
				return $root.$field->value;
			} else {
				for ( $i = 1 ; $i < self::$thumb_count; $i++ ) {
					if ( isset( $field->{'thumb'.$i} ) && $field->{'thumb'.$i} ) {
						return $root.$field->{'thumb'.$i};
					}
				}
			}
		}
	}
}
?>