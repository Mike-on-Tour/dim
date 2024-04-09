<?php
/**
*
* @package MoT DIM v0.1.0
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
	'MOT_DIM_LOG_DELETION'		=> '<strong>mot/dim hat folgende Benutzer gelöscht</strong><br>» %s',
]);
