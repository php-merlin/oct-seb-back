<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: xml.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// JCckDevXml
class JCckDevXml extends SimpleXMLElement
{
	// asHtml
	public function asHtml()
	{
		return html_entity_decode( $this->asIndentedXML( false, '', 0, -1 ), ENT_NOQUOTES, 'UTF-8' );
	}

	// asHtmlIndentedXML
	public function asHtmlIndentedXML()
	{
		$out	=	html_entity_decode( $this->asIndentedXML( false, "\t", 0, 1 ), ENT_NOQUOTES, 'UTF-8' );
		$out	=	str_replace( '&', '&amp;', $out );

		return $out;
	}

	// asIndentedXML
	public function asIndentedXML( $compressed = false, $indent = "\t", $level = 0, $xhtml = 0 )
	{
		$out	=	'';

		if ( !( $level == 0 && $xhtml == -1 ) ) {
			$pre	=	$level == 1 && $xhtml == -1 ? '' : "\n";
			$out	.=	( $compressed ) ? '' : $pre . str_repeat( $indent, $level );
			$out	.=	'<' . $this->getName();

			// Attributes
			foreach ( $this->attributes() as $attr ) {
				$out	.=	' ' . $attr->getName() . '="' . htmlspecialchars( (string)$attr, ENT_COMPAT, 'UTF-8') . '"';
			}
		}

		// Data
		if ( !count( $this->children() ) && !( (string)$this != '' ) ) {
			if ( !( $level == 0 && $xhtml == -1 ) ) {
				$out .= " />";
			}
		} else {
			if ( count( $this->children() ) ) {
				if ( !( $level == 0 && $xhtml == -1 ) ) {
					$out .= '>';
				}

				$level++;

				// Children (recursively)
				foreach ( $this->children() as $child ) {
					$out	.=	$child->asIndentedXML( $compressed, $indent, $level, $xhtml );
				}

				$level--;
				
				$pre	=	$level == 1 && $xhtml == -1 ? '' : "\n";
				$out	.=	($compressed) ? '' : $pre . str_repeat( $indent, $level );
			} elseif ( (string)$this != '' ) {
				if ( !( $level == 0 && $xhtml == -1 ) ) {
					$out .= '>';
				}

				if ( $xhtml ) {
					$out	.=	(string)$this;
				} else {
					$out	.=	htmlspecialchars( (string)$this, ENT_COMPAT, 'UTF-8' );
				}
			}

			if ( !( $level == 0 && $xhtml == -1 ) ) {
				$out .= '</' . $this->getName() . '>';
			}
		}

		return $out;
	}
}
?>