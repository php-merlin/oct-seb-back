<?php
defined( '_JEXEC' ) or die;

/* onInstallerAfterInstaller */

if ( !( is_array( $installer ) && ( $installer['type'] == 'language' || $installer['type'] == 'package' ) ) ) {
	return;
}
if ( !( is_object( $result ) && isset( $result->manifest->packagename ) ) ) {
	return;
}

$lang_tag	=	(string)$result->manifest->packagename;
$pk			=	JCckDatabase::loadResult( 'SELECT lang_id FROM #__languages WHERE lang_code = "'.$lang_tag.'"' );

if ( !$pk ) {
	return;
}

$content_language	=	new JCckContentLanguage;
$content_language->extend( __DIR__.'/extend/mixin_language.php' );
$content_type		=	'o_language';

if ( !$content_language->count( $content_type, array( 'lang_id'=>$pk ) ) ) {
	if ( $content_language->import( $content_type, $pk )->isSuccessful() ) {
		// Init
		$content_language->_( 'lang_sef', substr( $lang_tag, 0, 2 ) );
		$content_language->_( 'lang_tag', $lang_tag );

		// $params		=	array( 'associations'=>array(
		// 										'292'=>'246',
		// 										'294'=>'144',
		// 										'289'=>'247',
		// 										'293'=>'147',
		// 										'285'=>'123',
		// 										'316'=>'128'
		// 									   )
		// 				);

		// Create Nav: Main Menu
		// $content_language->_createNav( 'mainmenu-'.strtolower( $lang_tag ) );
		// $pks		=	$content_language->_createNavItems( array( 'language'=>'ru-RU', 'menutype'=>'mainmenu-ru-ru' ), 'mainmenu-'.strtolower( $lang_tag ), $params );
		// $redirect	=	$pks[283];

		// Create Nav: Hidden Menu
		// $pks		=	$content_language->_createNavItems( array( 'language'=>'ru-RU', 'menutype'=>'hiddenmenu' ), 'hiddenmenu', $params );

		// Create Nav: Footer Menu
		// $pks		=	$content_language->_createNavItems( array( 'language'=>'ru-RU', 'menutype'=>'footermenu' ), 'footermenu', $params );

		// Create Elements
		// $content_language->_createElements();

		// Create Fields
		// ...

		// Create Types
		// ...

		// Update Apps
		$content_language->_updateApps();

		// Store Language
		// $content_language->setProperty( 'published', 1 )
		// 				 ->setProperty( 'access_live', 3 )
		// 				 ->setProperty( 'redirect_items', $redirect )
		// 				 ->setProperty( 'type', 1 )
		// 				 ->store();
	}
}
?>