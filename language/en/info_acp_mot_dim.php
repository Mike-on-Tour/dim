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
	'ACP_MOT_DIM'						=> 'Delete inactive users',
	'ACP_MOT_DIM_SETTINGS'				=> 'Settings',

	'ACP_MOT_DIM_SETTINGS_EXPL'			=> 'Here you can change the settings for this extension.',
	'ACP_MOT_DIM_VERSION'				=> '<img src="https://img.shields.io/badge/Version-%1$s-green.svg?style=plastic"><br>&copy; 2024 by Mike-on-Tour',

	'ACP_MOT_DIM_GENERAL_SETTINGS'		=> 'General settings',
	'ACP_MOT_DIM_ENABLE'				=> 'Enable extension',
	'ACP_MOT_DIM_ENABLE_EXPL'			=> 'Using this switch you can enable or disable this extension.',

	'ACP_MOT_DIM_DELETE_SETTINGS'		=> 'Deletion settings',
	'ACP_MOT_DIM_DAYS_DELETE'			=> 'Number of days until deletion',
	'ACP_MOT_DIM_DAYS_DELETE_EXP'		=> 'Select the number of days since registration after which users will be deleted if they have neither activated their account nor logged
											into the board nor posted something.',
	'ACP_MOT_DIM_PROTECTED_USERS'		=> 'Protected users',
	'ACP_MOT_DIM_PROTECTED_USERS_EXPL'	=> 'Input of the usernames of users you want to protect against being deleted.<br>
											To remove a user from this list just remove the line with the respective username.<br><strong>Each username MUST BE on its own line!</strong>',
	'ACP_MOT_DIM_PROTECTED_GROUPS'		=> 'Protected groups',
	'ACP_MOT_DIM_PROTECTED_GROUPS_EXPL'	=> 'Please select the default group(s) whose members are to be protected against being reminded and deleted. Groups already selected are
											highlighted.<br>While pressing and holding the ´Ctrl´ key you can select more than one group by clicking the respective names.',

	'ACP_MOT_DIM_CRON_SETTINGS'			=> 'Cron settings',
	'ACP_MOT_DIM_CRON_INTERVAL'			=> 'Time iterval between two cron runs',
	'ACP_MOT_DIM_CRON_INTERVAL_EXPL'	=> 'Here you can select the time between two cron job runs including the selection of hours or days as the unit for this time frame.',
	'MOT_DIM_UNIT_HOUR'					=> 'Hour(s)',
	'MOT_DIM_UNIT_DAY'					=> 'Day(s)',
	'ACP_MOT_DIM_LAST_CRON_RUN'			=> 'Last cron run',

	'ACP_MOT_DIM_SETTING_SAVED'			=> 'The settings for this extension have been stored successfully.',

	'ACP_MOT_DIM_SUBMIT_CHANGES'		=> 'Submit changes',
]);
