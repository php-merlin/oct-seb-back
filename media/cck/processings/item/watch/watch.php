<?php
defined( '_JEXEC' ) or die;

if ( !( isset( $this ) && $this->isSecure() ) ) {
	return;
}

if ( !$this->getId() ) {
	return;
}

// Per App
/* TODO#SEBLOD4 */

// Per Item
if ( !$this->isNew() ) {
	$path	=	JPATH_SITE.'/cache/cck_item@'.$this->getId();

	if ( is_dir( $path ) ) {
		JFolder::delete( $path );
	}
}
?>