# Change Log
All changes to `Delete Inactive Members` will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

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

