<?php
defined( '_JEXEC' ) or die;

if ( $context != 'com_cck.folder' ) {
	return;
}
if ( !$item->id ) {
	return;
}

// App
if ( $item->home && $item->app ) {
	$name	=	'app_cck_'.$item->app;

	if ( is_file( JPATH_ADMINISTRATOR.'/manifests/packages/pkg_'.$name.'.xml' ) ) {
		JFile::delete( JPATH_ADMINISTRATOR.'/manifests/packages/pkg_'.$name.'.xml' );

		JCckDatabase::execute( 'DELETE IGNORE a.* FROM #__extensions AS a WHERE a.type="package" AND a.name="pkg_'.$name.'"' );

		if ( is_dir( JPATH_ADMINISTRATOR.'/manifests/packages/'.$name.'/' ) ) {
			JFolder::delete( JPATH_ADMINISTRATOR.'/manifests/packages/'.$name.'/' );
		}
		if ( is_dir( JPATH_SITE.'/project/apps/'.$item->app.'/' ) ) {
			JFolder::delete( JPATH_SITE.'/project/apps/'.$item->app.'/' );
		}
	}
}

// Construction
$elements	=	array(
					'searchs'=>'Search',
					'types'=>'Type'
				);

foreach ( $elements as $k=>$v ) {
	$items	=	JCckDatabase::loadColumn( 'SELECT id FROM #__cck_core_'.$k.' WHERE folder = '.(int)$item->id );

	if ( count( $items ) ) {
		$table	=	JTable::getInstance( $v, 'CCK_Table' );

		foreach ( $items as $pk ) {
			$table->delete( $pk );
		}
	}
}

// Fields
JCckDatabase::execute( 'DELETE IGNORE a.*, b.*'
					.  ' FROM #__cck_core_fields AS a'
					.  ' LEFT JOIN #__cck_core AS b ON (b.pk = a.id AND b.storage_location="cck_field")'
					.  ' WHERE a.folder='.(int)$item->id );
?>