<?php
defined( '_JEXEC' ) or die;

if ( !( isset( $article->id ) && $article->id ) ) {
	return;
}

// Prepare
if ( $context == 'com_menus.menu' ) {
	$content		=	new JCckContentMenu;
	$content_type	=	'o_nav_list';
} elseif ( $context == 'com_menus.item' ) {
	$item_request	=	array();
	$item_types		=	array(
							'alias'=>true,
							'heading'=>true,
							'separator'=>true,
							'url'=>true
						);

	if ( !isset( $item_types[$article->type] ) ) {
		if ( $article->type == 'component' ) {
			$request	=	explode( '&', $article->link );

			if ( strpos( $article->link, '?option=com_cck&view=list' ) !== false ) {
				foreach ( $request as $k=>$v ) {
					if ( strpos( $v, 'search=' ) !== false || strpos( $v, 'task=' ) !== false ) {
						$parts						=	explode( '=', $v );
						$item_request[$parts[0]]	=	$parts[1];
					}
				}
				$item_type	=	'com_cck.list';
			} elseif ( strpos( $article->link, '?option=com_cck&view=form' ) !== false ) {
				foreach ( $request as $k=>$v ) {
					if ( strpos( $v, 'type=' ) !== false ) {
						$parts						=	explode( '=', $v );
						$item_request[$parts[0]]	=	$parts[1];
					}
				}
				$item_type	=	'com_cck.form';
			} elseif ( strpos( $article->link, '?option=com_cck_toolbox&view=processing' ) !== false ) {
				$item_type	=	'com_cck.custom';
			} elseif ( strpos( $article->link, '?option=com_cck_webservices&view=api_docs' ) !== false ) {
				$item_type	=	'com_cck.api-docs';
			} elseif ( strpos( $article->link, '?option=com_cck_webservices&view=api' ) !== false ) {
				$item_type	=	'com_cck.api';
			} elseif ( strpos( $article->link, '?option=com_content&view=article' ) !== false ) {
				foreach ( $request as $k=>$v ) {
					if ( strpos( $v, 'id=' ) !== false ) {
						$parts						=	explode( '=', $v );
						$item_request[$parts[0]]	=	$parts[1];
					}
				}
				$item_type	=	'com_content.article';
			} elseif ( strpos( $article->link, '?option=com_content&view=category' ) !== false ) {
				foreach ( $request as $k=>$v ) {
					if ( strpos( $v, 'id=' ) !== false ) {
						$parts						=	explode( '=', $v );
						$item_request[$parts[0]]	=	$parts[1];
					}
				}
				$item_type	=	'com_content.category';
			} else {
				return;
			}
		} else {
			return;
		}
	} else {
		$item_type		=	$article->type;
	}

	$content		=	new JCckContentMenuItem;
	$content_type	=	'o_nav_item';
} else {
	return;
}

// Process
$doMore	=	false;

if ( $content->load( $article->id )->isSuccessful() ) {
	$doMore	=	true;
} elseif ( $content->import( $content_type, $article->id )->isSuccessful() ) {
	$doMore	=	true;
}

if ( $doMore && $content_type == 'o_nav_item' ) {
	$content->setProperty( 'item_type', $item_type );
	$content->setProperty( 'item_request', json_encode( $item_request ) );
	$content->store();
}
?>