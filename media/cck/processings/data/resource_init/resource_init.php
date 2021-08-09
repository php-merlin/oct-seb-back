<?php
defined( '_JEXEC' ) or die;

if ( !isset( $options ) ) {
	return;	
}
$opts	=	$options->toArray();

// Let's make sure we have the suitable Apps
if ( !( isset( $opts['apps'] ) && $opts['apps'] != '' ) ) {
	return;
}

$opts['apps']	=	explode( ',', $opts['apps'] );

// ---
JFactory::getApplication()->input->set( 'cck_is_job', 1 );
// ---

foreach ( $opts['apps'] as $app_name ) {
	$res_name	=	substr( $app_name, 2 );

	$outputs	=	array(
						'data'=>array(),
						'debug'=>array()
					);
	$path_in	=	JPATH_SITE.'/project/apps/'.$app_name.'/data/in/'.$res_name.'.json';
	$path_out	=	JPATH_SITE.'/project/apps/'.$app_name.'/data/out/'.$res_name;

	if ( is_file( $path_in ) ) {
		$buffer_in	=	file_get_contents( $path_in );

		if ( $buffer_in ) {
			$input	=	json_decode( $buffer_in, true );
			$input	=	isset( $input['data'] ) ? $input['data'] : $input;
			
			foreach ( $input as $input_data ) {
				$r	=	JCckWebservice::input( $res_name, $input_data );

				if ( $r === false ) {
					$outputs['data'][]	=	$input_data;
					$outputs['debug'][]	=	array( 'request_data'=>$input_data, 'response_body'=>array() );
				} elseif ( is_array( $r ) && isset( $r['status'] ) && $r['status'] == 'error' ) {
					$outputs['data'][]	=	$input_data;
					$outputs['debug'][]	=	array( 'request_data'=>$input_data, 'response_body'=>$r );
				}
			}

			if ( count( $outputs['data'] ) ) {
				jimport( 'joomla.filesystem.file' );

				$outputs['data']	=	json_encode( array( 'data'=>$outputs['data'] ), JSON_PRETTY_PRINT );
				$outputs['debug']	=	json_encode( $outputs['debug'], JSON_PRETTY_PRINT );

				JFile::write( $path_out.'.json', $outputs['data'] );
				JFile::write( $path_out.'@debug.json', $outputs['debug'] );
			}
		}
	} else {
		echo 'KO';
	}
}
?>