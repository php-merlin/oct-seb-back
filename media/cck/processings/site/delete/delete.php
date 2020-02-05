<?php
defined( '_JEXEC' ) or die;

if ( $context != 'com_cck.site' ) {
	return;
}
if ( !is_object( $item ) ) {
	return;
}

// Prepare
$item->groups		.=	','.$item->guest_only_groups;
$item->users		.=	','.$item->guest;
$item->viewlevels	.=	','.$item->guest_only_viewlevel;

// Remove Groups
$groups		=	explode( ',', $item->groups );
$content	=	new JCckContentUserGroup;

foreach ( $groups as $group_id ) {
	$content->delete( $group_id, 'user_group' );
}

// Remove Users
$users		=	explode( ',', $item->users );
$content	=	new JCckContentUser;

foreach ( $users as $user_id ) {
	$content->delete( $user_id, 'o_user' );
}

// Remove Viewlevels
$viewlevels	=	explode( ',', $item->viewlevels );
$content	=	new JCckContentAccess;

foreach ( $viewlevels as $viewlevel_id ) {
	$content->delete( $viewlevel_id, 'viewing_access_level' );
}
?>