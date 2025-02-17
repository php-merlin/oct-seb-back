<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: router.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// CckRouter
class CckRouter extends JComponentRouterBase
{
	// build
	public function build( &$query )
	{
		$app		=	JFactory::getApplication();
		$menu		=	$app->getMenu();
		$segments	=	array();

		// Prevent..
		if ( isset( $query['view'] ) ) {
			$view	=	$query['view'];
		// } elseif ( isset( $query['task'] ) && $query['task'] == 'download' ) {
		// 	$hash	=	'file='.$query['file'].'&id='.$query['id'].'&collection=';

		// 	if ( isset( $query['collection'] ) ) {
		// 		$hash	.=	$query['collection'];
		// 	}

		// 	$hash	.=	'&xi=';

		// 	if ( isset( $query['xi'] ) ) {
		// 		$hash	.=	$query['xi'];
		// 	}

		// 	$segments[]	=	base64_encode( $hash );

		// 	unset( $query['file'], $query['id'], $query['collection'], $query['xi'] );

		// 	return $segments;
		} else {
			return $segments;
		}
		
		// Prevent..		
		if ( $view == 'box' ) {
			return $segments;
		}

		// SEBLOD => Form
		if ( $view == 'form' ) {
			$segments[]	=	'form';
			if ( isset( $query['type'] ) ) {
				$segments[]	=	$query['type'];
				unset( $query['type'] );
			}
			
			unset( $query['view'] );
			unset( $query['layout'] );

			return $segments;
		}
		
		// SEBLOD => Content Objects
		if ( empty( $query['Itemid'] ) ) {
			$menuItem	=	$menu->getActive();
		} else {
			$menuItem	=	$menu->getItem( $query['Itemid'] );
		}
		
		if ( !isset( $menuItem->query['search'] ) ) {
			if ( isset( $query['catid'] ) ) {
				$segments[]	=	$query['catid'];
				unset( $query['catid'] );
			}
			if ( isset( $query['id'] ) ) {
				$segments[]	=	$query['id'];
				unset( $query['id'] );
			}
		} else {
			$params		=	JCckDevHelper::getRouteParams( $menuItem->query['search'] );

			if ( isset( $params['location'] ) && $params['location'] != '' && is_file( JPATH_SITE.'/plugins/cck_storage_location/'.$params['location'].'/'.$params['location'].'.php' ) ) {	
				require_once JPATH_SITE.'/plugins/cck_storage_location/'.$params['location'].'/'.$params['location'].'.php';
				JCck::callFunc_Array( 'plgCCK_Storage_Location'.$params['location'], 'buildRoute', array( &$query, &$segments, $params, $menuItem ) );
			}
		}
		
		unset( $query['view'] );
		
		$total	=	count( $segments );
		
		for ( $i = 0; $i < $total; $i++ ) {
			$segments[$i]	=	str_replace( ':', '-', $segments[$i] );
		}
		
		return $segments;
	}

	// parse
	public function parse( &$segments )
	{
		$app		=	JFactory::getApplication();
		$count		=	count( $segments );
		$menu		=	$app->getMenu();
		$menuItem	=	$menu->getActive();
		$vars		=	array();

		if ( $app->input->get( 'task' ) == 'ajax' ) {
			return $vars;
		}
		// elseif ( $app->input->get( 'task' ) == 'download' ) {
		// 	if ( $segments[0] != '' ) {
		// 		$vars	=	JCckDevHelper::getUrlVars( base64_decode( $segments[0] ) );
		// 		$vars	=	$vars->toArray();
		// 	}
			
		// 	return $vars;
		// }
		if ( $segments[0] == 'form' ) {
			$menu->setActive( $app->input->getInt( 'Itemid', 0 ) );
			$vars['option']	=	'com_cck';
			$vars['view']	=	'form';
			$vars['layout']	=	'edit';
			$vars['type']	=	@$segments[1];
		} else {
			$params		=	array();

			if ( isset( $menuItem->query['search'] ) ) {
				$params	=	JCckDevHelper::getRouteParams( $menuItem->query['search'], $menuItem->params->get( 'sef', '' ) );
				
				if ( ( ( $params['doSEF'][0] == '4' || $params['doSEF'][0] == '5' ) && $count == 1 )
				  || ( ( $params['doSEF'][0] == '8' ) && ( $count == 1 || $count == 2 ) ) ) {
					if ( isset( $params['location'] ) && $params['location'] && is_file( JPATH_SITE.'/plugins/cck_storage_location/'.$params['location'].'/'.$params['location'].'.php' ) ) {
						require_once JPATH_SITE.'/plugins/cck_storage_location/'.$params['location'].'/'.$params['location'].'.php';

						$target			=	( $params['doSEF'][0] == '5' ) ? 'author_object' : 'parent_object';
						$properties		=	array( $target );
						$properties		=	JCck::callFunc( 'plgCCK_Storage_Location'.$params['location'], 'getStaticProperties', $properties );

						if ( $properties[$target] != '' ) {
							$params['doSEF'][0]	=	$count == 2 ? '4' : '2';
							$isNew				=	true;
							$parent_id			=	(int)$menuItem->parent_id;
							
							if ( $parent_id > 1 ) {
								$parent	=	$menu->getItem( $parent_id );

								if ( is_object( $parent ) ) {
									if ( $parent->query['option'] == 'com_cck' && $parent->query['view'] == 'list' ) {
										$isNew	=	false;
									}
								}
							}
							if ( $isNew ) {
								$params['doSEF'][1]	=	'3';
								$params['location']	=	$properties[$target];
							}
						}
					}
				} elseif ( $params['doSEF'][0] == '2' && $count > 1 ) {
					require_once JPATH_SITE.'/plugins/cck_storage_location/'.$params['location'].'/'.$params['location'].'.php';
					
					$target				=	'child_object';
					$properties			=	array( $target );
					$properties			=	JCck::callFunc( 'plgCCK_Storage_Location'.$params['location'], 'getStaticProperties', $properties );

					if ( $properties[$target] != '' ) {
						$params['doSEF'][0]	=	'4';
						$params['location']	=	$properties[$target];
					}
				}
			}
			if ( isset( $params['location'] ) && $params['location'] && is_file( JPATH_SITE.'/plugins/cck_storage_location/'.$params['location'].'/'.$params['location'].'.php' ) ) {
				require_once JPATH_SITE.'/plugins/cck_storage_location/'.$params['location'].'/'.$params['location'].'.php';
				JCck::callFunc_Array( 'plgCCK_Storage_Location'.$params['location'], 'parseRoute', array( &$vars, $segments, $count, $params ) );
			} else {
				if ( isset( $menuItem->query['option'], $menuItem->query['view'] )
				  && $menuItem->query['option'] == 'com_cck' && $menuItem->query['view'] == 'form' ) {
				  	if ( $menuItem->id != JCckDevHelper::getApp( 'more' )->params->get( 'menu_item.Admin', 0 ) ) {
						throw new Exception( JText::_( 'JERROR_PAGE_NOT_FOUND' ), 404 );
					}
				} else {
					if ( $count == 2 ) {
						$vars['option']		=	'com_content';
						$vars['view']		=	'article';
						$vars['catid']		=	$segments[0];
						$vars['id']			=	$segments[1];
					} elseif ( $count == 1 ) {
						$vars['option']		=	'com_content';

						jimport( 'joomla.application.categories' );
						
						$idArray			=	explode( ':', $segments[0], 2 );
						$id					=	(int)$idArray[0];
						$alias				=	(string)@$idArray[1];
						$category			=	JCategories::getInstance( 'Content' )->get( $id );

						if ( $category && $category->id == $id && $category->alias == $alias ) {
							$vars['view']	=	'categories';
						} else {
							$vars['view']	=	'article';
						}
						$vars['id']			=	$segments[0];
					}
				}
			}
		}
		
		return $vars;
	}
}

// CckBuildRoute
function CckBuildRoute( &$query )
{
	$router	=	new CckRouter;

	return $router->build( $query );
}

// CckParseRoute
function CckParseRoute( $segments )
{
	$router	=	new CckRouter;

	return $router->parse( $segments );
}
?>