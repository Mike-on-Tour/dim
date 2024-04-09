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
	'ACP_MOT_DIM'						=> 'Lösche inaktive Mitglieder',
	'ACP_MOT_DIM_SETTINGS'				=> 'Einstellungen',

	'ACP_MOT_DIM_SETTINGS_EXPL'			=> 'Hier können Sie die Einstellungen für diese Erweiterung ändern.',
	'ACP_MOT_DIM_VERSION'				=> '<img src="https://img.shields.io/badge/Version-%1$s-green.svg?style=plastic"><br>&copy; 2024 by Mike-on-Tour',

	'ACP_MOT_DIM_GENERAL_SETTINGS'		=> 'Allgemeine Einstellungen',
	'ACP_MOT_DIM_ENABLE'				=> 'Funktion aktivieren',
	'ACP_MOT_DIM_ENABLE_EXPL'			=> 'Mit diesem Schalter können Sie die Erweiterung aktivieren bzw. deaktivieren.',

	'ACP_MOT_DIM_DELETE_SETTINGS'		=> 'Lösch-Einstellungen',
	'ACP_MOT_DIM_DAYS_DELETE'			=> 'Anzahl Tage bis zum Löschen',
	'ACP_MOT_DIM_DAYS_DELETE_EXP'		=> 'Anzahl der Tage nach der Registrierung bis zum automatischen Löschen des Mitgliedes, wenn es in dieser Zeit keine Aktivierung des
											Accounts oder kein Anmelden gab oder das Mitglied keinen Beitrag verfasst hat.',
	'ACP_MOT_DIM_PROTECTED_USERS'		=> 'Geschützte Mitglieder',
	'ACP_MOT_DIM_PROTECTED_USERS_EXPL'	=> 'Eingabe der Benutzernamen von Mitgliedern, die von einer Löschung ausgenommen werden sollen.<br>
											Zeilen mit Mitgliedernamen entfernen, um diese Mitglieder aus dieser Liste zu löschen.<br><strong>Nur ein Name pro Zeile!</strong>',
	'ACP_MOT_DIM_PROTECTED_GROUPS'		=> 'Geschützte Gruppen',
	'ACP_MOT_DIM_PROTECTED_GROUPS_EXPL'	=> 'Auswahl von Hauptgruppe(n), deren Mitglieder von einer Löschung ausgenommen werden sollen. Bereits ausgewählte Gruppen sind hervorgehoben.<br>
											Unter Drücken und Halten der ´Strg´-Taste und Mausklick können mehrere Gruppen ausgewählt werden.',

	'ACP_MOT_DIM_CRON_SETTINGS'			=> 'Cron-Einstellungen',
	'ACP_MOT_DIM_CRON_INTERVAL'			=> 'Zeit zwischen zwei Cron-Läufen',
	'ACP_MOT_DIM_CRON_INTERVAL_EXPL'	=> 'Hier können Sie die Zeit zwischen zwei Aufrufen des Cron-Jobs einstellen. Außerdem hast du die Wahl zwischen Tagen und Stunden für die
											Auswahl dieses Zeitraumes.',
	'MOT_DIM_UNIT_HOUR'					=> 'Stunde(n)',
	'MOT_DIM_UNIT_DAY'					=> 'Tag(e)',
	'ACP_MOT_DIM_LAST_CRON_RUN'			=> 'Letzter Cron-Lauf',

	'ACP_MOT_DIM_SETTING_SAVED'			=> 'Die Einstellungen für die Erweiterung wurden erfolgreich gesichert.',

	'ACP_MOT_DIM_SUBMIT_CHANGES'		=> 'Änderungen übermitteln',
]);
