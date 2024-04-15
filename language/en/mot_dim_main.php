<?php
/**
*
* @package MoT DIM v1.0.0
* @copyright (c) 2024 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if ( !defined('IN_PHPBB') )
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'MOT_DIM_CHECK_RESULT'		=> 'Test DIM settings',
	'MOT_DIM_NO_ITEMS'			=> 'No items',
	'MOT_DIM_TOTAL_USERS'		=> '%1$d members total',
	'MOT_DIM_REGISTERED'		=> 'Registered',
	'MOT_DIM_NOT_ACTIVATED'		=> 'Not activated',
	'MOT_DIM_SLEEPER'			=> 'Never logged in',
	'MOT_DIM_ZEROPOSTER'		=> 'Zeroposter',
	'MOT_DIM_LOG_DELETION'		=> '<strong>mot/dim deleted the following users</strong><br>» %s',
]);
