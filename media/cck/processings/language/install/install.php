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

		// Create Nav
		$content_language->_parseNavLists();

		// Create Elements
		$content_language->_createElements();

		// Create Fields
		$content_language->_createFields(); // base only?!

		// Create Types
		// ...

		// Update Apps
		$content_language->_updateApps(); // more only?!

		// Store Language
		$content_language->setProperty( 'published', 1 )
						 ->store();
	}
}
?>