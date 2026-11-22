<?php
/**
*
* @package MoT DIM v1.3.1
* @copyright (c) 2024 - 2026 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\dim\migrations;

class v_1_3_1 extends \phpbb\db\migration\migration
{

	/**
	* Check whether the predecessor migration exists
	*/
	public static function depends_on()
	{
		return ['\mot\dim\migrations\v_0_1_0'];
	}

	public function update_data()
	{
		return [
			// Add the config_text variable we want to be able to set
			['config_text.add', ['mot_dim_protected_users', $this->config['mot_dim_protected_users']]],
			['config.remove', ['mot_dim_protected_users']],
		];
	}
}
