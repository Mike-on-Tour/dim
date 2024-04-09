# phpBB Delete Inactive Members Extension

![Version: 0.1.0(https://img.shields.io/badge/Version-0.1.0-green)  
  
![phpBB 3.3.x Compatible](https://img.shields.io/badge/phpBB-3.3.x%20Compatible-009BDF)  

## Description
This extension lets the administrator automatically delete any users who have neither activated their account nor visited the site in question after activation nor posted.
In the ACP the administrator can select the number of days since registration after which the approbriate users will be deleted. Protection from deletion can defined for single
users by identifying them by their username or for groups in which users are a member, these groups must be the default group of the users to be protected.
Users are get deleted by a cron job which intervals between two runs can be defined within the ACP for either hours or days. With each run the cron job handles a amxumum of 1,000
users to prevent a heavy load on the database. So if you have a big number of users which are either inactive, sleepers or zeroposters it would be best to run the cron job every
hour or so to get rid of a large chunk of users in a short period of time. After cleaning or database you might want to set the interval to one or even mor days.
  
## Install

1. Download the latest release.
2. Unzip the downloaded file.
3. Copy the unzipped folder to `/ext/` (if done correctly, you'll have the main extension class at `(your forum root)/ext/mot/dim/composer.json`).
4. Navigate in the ACP to `Customise -> Manage extensions`.
5. Look for `Delete Inactive Members` under the Disabled Extensions list, and click its `Enable` link.

## Update

1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Delete Inactive Members` under the Enabled Extensions list, and click its `Disable` link.
3. Using your favorite FTP software go to the `(your forum root)/ext/mot/dim` folder and delete all files and directories.
4. Locally unzip the file `mot_dim_x.y.z.zip` file (x, y and z are numbers indicating the major version, minor version and patch level).
5. Upload all files from your unzipped `dim` folder to your server into the `(your forum root)/ext/mot/dim`, please make certain that you use the binary mode for uploading.
6. Go back to the ACP and look for `Delete Inactive Members` under the Disabled Extensions list, and click its `Enable` link.

## Uninstall

1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Delete Inactive Members` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/mot/dim` folder.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
