# Change Log
All changes to `Delete Inactive Members` will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [0.1.0] - 2024-04-10

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

