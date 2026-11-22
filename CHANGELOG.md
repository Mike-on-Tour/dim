# Change Log
All changes to `Delete Inactive Members` will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [1.3.1] - 2026-11-20
Special thanks to LukeWCS (phpbb.de) who pointed a desperate, blind man to the correct backslash

### Added
-	A `version.php` file which creates the version badge on the ACP settings page from the `version` info in `composer.json`
-	A new event handler in `adm/style/mot_dim_acp.js` to enable the "Test settings" button when the "Reset" button is clicked
-	A new migration file `migrations/v_1_3_1.php` to add a `config_text` variable holding the protected users (instead of using a `config` variable with limited capacity)

### Changed
-	The function getting version information in `ext.php` to get the required minimum and maximum phpBB versions from the `composer.json` file's `extra` section
-	Getting the paginated users to display with `controller/mot_dim_result_check.php` from another SQL query to an array operation on the already existing array and thus
	saving one SQL query
-	The version badge on the settings page no longer is a link to "https://img.shields.io" but to a new PHP file creating the version badge as SVG image
-	Getting the groups for the protected groups select field from default groups to all groups assigned to the human users in `controller/mot_dim_acp.php`
-	Selecting users for deletion in `controller/mot_dim_result_check.php` and `cron/task/mot_dim_cron.php` now incorporates all groups users belong to and not only their
	default group while checking if a user belongs to a protected group

### Fixed
-	A missing authorization check in `controller/mot_dim_result_check.php` which resulted in a security issue, now admin permissions are required to view the list of Inactive
	members through the "Test settings" button on the ACP settings page
-	SQL queries in `controller/mot_dim_acp.php`, `controller/mot_dim_result_check.php` and `cron/task/mot_dim_cron.php` in order to function with PostgreSQL
-	SQL queries in `controller/mot_dim_result_check.php` and `cron/task/mot_dim_cron.php` in order to correctly discriminate zeroposters
-	The query limit in `cron/task/mot_dim_cron.php` which was incompatible with MSSQL and Oracle
-	The missing declaration of the `$u_action` variable in `controller/mot_dim_acp.php`
-	The reused "for=" declarations in `adm/style/acp_mot_dim_settings.html`, lines 28 and 33
-	The inadvertent opening of the test settings popup when pressing "Enter" by defining the "Test settings" control as button instead of submit
-	Missing server side checks for the correct values of days until deletion, cron task unit and interval
-	Missing `parseInt()` handlers in `adm/style/mot_dim_acp.js`, line 42 to properly check if the cron task interval exceeds the number of days until deletion
-	The unused parsed comparison operators in `ext.php`, lines 70 and 75
-	A wrong indentation in `adm/style/acp_mot_dim_settings.html`, line 43
-	A wrong controller type in the doc block at `acp/mot_dim_acp_module.php`, line 30

### Removed


## [1.3.0] - 2026-10-08

### Added
-	A function to the `ext.php` file to get the minimum and maximum versions and their respective conditions from the `require` section of the `composer.json` file in order to
	prevent errors due to the duplicate entries in those two files
-	Dynamic JSON Badges to the `README.md` file to get the currently valid version information from the GitHub repository's `composer.json` file
-	Events to the input elements of the "Deletion settings" section of `adm/style/acp_mot_dim_settings.html` to disable the "Test settings" button
-	A `:disabled` color definition to the "Test settings" button in `adm/style/mot_dim_acp.css`

### Changed
-	Minimum version of phpBB to 3.3.9
-	PHP Compatibility to minimum version of PHP 8.1.33 and maximum version of 8.6.x
-	The switch macro in `adm/style/acp_mot_dim_settings.html` to the current version of "Toggle Control" (by LukeWCS) and incorporated an id tag
-	Improved code readability

### Fixed
-	The maximum number for the initial display of the `mot_dim_cron_interval` input in `adm/style/acp_mot_dim_settings.html` (5 instead of 23)
-	The wrong sequence of first querying the database and then validate the `$start` variable in `controller/mot_dim_result_check.php` which resulted in an empty table if the
	user selected manually a higher page number than was possible

### Removed


## [1.2.0] - 2025-11-25

### Added

### Changed
-	Minimum version of phpBB to 3.3.4
-	PHP Compatibility to minimum version of PHP 8.0.30 and maximum version of 8.5.x
-	The condition under which the cron task is active (is_runnable) from always true to depending on activation of the functionality within the ACP settings page
-	All constructor declarations to [Constructor Property Promotion](https://www.php.net/releases/8.0/de.php#constructor-property-promotion) (a new PHP feature starting with PHP 8.0)
-	All function declarations into parameters with type declarations

### Fixed
-	A missing plural language variable in `language/xx/mot_dim_main.php`

### Removed


## [1.1.1] - 2024-11-23

### Added

### Changed
-	PHP Compatibility now includes PHP 8.4.x

### Fixed

### Removed


## [1.1.0] - 2024-09-05

### Added
-	An `ORDER BY u.user_id ASC` to the SQL query in `cron/task/mot_dim_cron.php` in order to get oldest users first
-	Improved the logging by discerning the log messages by the deleted user type (suggested by LukeWcs)

### Changed
-	Some variable names in `cron/task/mot_dim_cron.php` from camel case to snake case

### Fixed

### Removed


## [1.0.2] - 2024-08-25

### Added

### Changed

### Fixed
-	The wrong sequence of function calls to delete users and then try to get usernames for deleted user_ids for logging in `cron/task/mot_dim_cron.php` (bug reported by LukeWCS)

### Removed


## [1.0.1] - 2024-08-21

### Added
-	An additional condition to check for the USER_TABLE's `user_lastpost_time` and POSTS_TABLE's `post_visibility` columns to prevent zeroposters from being deleted if they
	posted once and this post has not been approved when the user was due for deletion (suggested by LukeWCS)

### Changed

### Fixed

### Removed


## [1.0.0] - 2024-04-14

### Added
-	Added two switches to the ACP settings page to incorporate sleepers and zeroposters into the deletion

### Changed
-	The building of the SQL query within `cron/task/mot_dim_cron.php`
-	The last column of the "test settings" window from displaying only not activated members to the reason why members are displayed

### Fixed

### Removed
-	The comment that disabled the actual deletion of the selected users within `cron/task/mot_dim_cron.php`


## [0.2.0] - 2024-04-10

### Added
-	A warning notice to the language key which explains the enabling switch
-	A new function to display those users who would be deleted while applying the current settings with the new files `config/routing.yml`, `controller/mot_dim_result_check.php`
	and `styles/all/template/mot_dim_result_check.html`

### Changed
-	The config value for enabling the extension from `true` (enabled) to `false` (disabled) to prevent an inadvertent usage
-	Renamed the language file `mot_dim_log.php` into `mot_dim_main.php`

### Fixed

### Removed


## [0.1.0] - 2024-04-09

### Added
-	The basic directory and file structure necessary for a phpBB 3.3.x extension
-	`CHANGELOG.md` and `README.md` files
-	The `ext.php` file and its necessary language files (`language/de/mot_dim_ext_enable_error.php`, `language/de_x_sie/mot_dim_ext_enable_error.php`,
	`language/en/mot_dim_ext_enable_error.php`)
-	The files necessary for creating the ACP (`acp/mot_dim_acp_info.php`, `acp/mot_dim_acp_module.php`, `adm/style/acp_mot_dim_settings.html`, `adm/style/mot_dim_acp.css`,
	`adm/style/mot_dim_acp.js`, `config/services.yml`, `controller/mot_dim_acp.php`, `language/de/info_acp_mot_dim.php`, `language/de_x_sie/info_acp_mot_dim.php`,
	`language/en/info_acp_mot_dim.php` and `migrations/v_0_1_0.php`)
-	A listener file `event/mot_dim_listener.php` to load the language array for logging user deletion

### Changed

### Fixed

### Removed

