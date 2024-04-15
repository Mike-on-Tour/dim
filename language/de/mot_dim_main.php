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
	'MOT_DIM_CHECK_RESULT'		=> 'DIM-Einstellungen testen',
	'MOT_DIM_NO_ITEMS'			=> 'Keine Einträge',
	'MOT_DIM_TOTAL_USERS'		=> '%1$d Mitglieder insgesamt',
	'MOT_DIM_REGISTERED'		=> 'Registriert',
	'MOT_DIM_NOT_ACTIVATED'		=> 'Nicht aktiviert',
	'MOT_DIM_SLEEPER'			=> 'Nie eingeloggt',
	'MOT_DIM_ZEROPOSTER'		=> 'Nullposter',
	'MOT_DIM_LOG_DELETION'		=> '<strong>mot/dim hat folgende Benutzer gelöscht</strong><br>» %s',
]);
