<?php
defined( '_JEXEC' ) or die;

if ( !( $config['id'] && !$config['isNew'] ) ) {
	return;
}

$path	=	JPATH_SITE.'/cache/cck_item@'.(int)$config['id'];

if ( is_dir( $path ) ) {
	JFolder::delete( $path );
}
?>