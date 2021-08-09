<?php
defined( '_JEXEC' ) or die;

if ( !isset( $options ) ) {
	return;	
}
$opts	=	$options->toArray();

$max	=	isset( $opts['max'] ) && $opts['max'] != '' ? $opts['max'] : 100;
$to		=	isset( $opts['to'] ) && $opts['to'] != '' ? $opts['to'] : '';

if ( !$to ) {
	return;
}

$to	=	explode( ';', $to );

if ( (int)JCckDatabase::loadResult( 'SELECT COUNT(id) FROM #__cck_more_webservices_stack WHERE published = 1' ) > $max ) {
	require_once JPATH_SITE.'/project/helper.php';
	
	ProjectHelper::sendEmail( $to, 'Monitoring: Stack', '<p>'.$max.' rows currently stacked... Is there any issue?</p>' );
}
?>