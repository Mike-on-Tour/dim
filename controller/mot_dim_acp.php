<?php
/**
*
* @package MoT DIM v1.3.1
* @copyright (c) 2024 - 2026 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\dim\controller;

class mot_dim_acp
{
	public $u_action;

	public function __construct(
		protected \phpbb\config\config $config,
		protected \phpbb\config\db_text $config_text,
		protected \phpbb\db\driver\driver_interface $db,
		protected \phpbb\group\helper $group_helper,
		protected \phpbb\controller\helper $helper,
		protected \phpbb\language\language $language,
		protected \phpbb\request\request_interface $request,
		protected \phpbb\template\template $template,
		protected \phpbb\user $user,
		protected $root_path,
		protected $php_ext
	)
	{
	}

	public function settings()
	{
		$form_key = 'acp_mot_dim_settings';
		add_form_key($form_key);

		// Check for this function and include it if not existent since it is needed to convert user_id into usernames and vice versa for the protected members section
		if (!function_exists('user_get_id_name'))
		{
			include($this->root_path . 'includes/functions_user.' . $this->php_ext);
		}

		$action = $this->request->variable('action', '');
		switch ($action)
		{
			case 'submit':
				if (!check_form_key($form_key))
				{
					trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// get the names of members to be protected and convert it to array of user_ids
				$protected_users_ids = [];
				$protected_users_names = $this->request->variable('mot_dim_protected_users', '', true);
				if (!empty($protected_users_names))
				{
					$username_arr = explode("\n", $protected_users_names);
					$result = user_get_id_name($protected_users_ids, $username_arr, false, true);
					sort($protected_users_ids);
				}

				// Get the number of days after registration until deletion and check its value against the min and max values, set it to 5 (default defined in migration) if it is out of range
				$days_until_deletion = $this->request->variable('mot_dim_days_delete', 0);
				$days_until_deletion = in_array($days_until_deletion, range(1, 70)) ? $days_until_deletion : 5;

				// Get the interval unit for the cron task, check if it is within the limits and set it to 1 (default defined in migration) if it is out of range
				$cron_unit = $this->request->variable('mot_dim_cron_unit', 0);
				$cron_unit = in_array($cron_unit, [0 , 1]) ? $cron_unit : 1;

				// Get the interval for the cron task and check its value in dependence of the interval unit against the min and max values and set it accordingly
				$cron_interval = $this->request->variable('mot_dim_cron_interval', 0);
				switch ($cron_unit)
				{
					// Unit is hours
					case 0:
						$cron_interval = in_array($cron_interval, range(1, 23)) ? $cron_interval * 3600 : 43200;
						break;

					// Unit is days
					case 1:
						$cron_interval = in_array($cron_interval, range(1, $days_until_deletion)) ? $cron_interval * 86400 : 86400;
						break;
				}

				$this->config->set('mot_dim_enable', $this->request->variable('mot_dim_enable', 0));
				$this->config->set('mot_dim_days_delete', $days_until_deletion);
				$this->config->set('mot_dim_enable_sleeper', $this->request->variable('mot_dim_enable_sleeper', 0));
				$this->config->set('mot_dim_enable_zeropost', $this->request->variable('mot_dim_enable_zeropost', 0));
				$this->config_text->set('mot_dim_protected_users', json_encode($protected_users_ids));
				$this->config->set('mot_dim_protected_groups', json_encode($this->request->variable('mot_dim_protected_groups', [0])));
				$this->config->set('mot_dim_cron_gc', $cron_interval);
				$this->config->set('mot_dim_cron_unit', $cron_unit);

				trigger_error($this->language->lang('ACP_MOT_DIM_SETTING_SAVED') . adm_back_link($this->u_action));

				break;
		}

		// Get the user_ids of protected members and convert it to string for use in template
		$username_arr = [];
		$protected_users_ids = json_decode($this->config_text->get('mot_dim_protected_users'));
		user_get_id_name($protected_users_ids, $username_arr);
		sort($username_arr);
		$protected_users_names = implode("\n", $username_arr);

		// Get the group properties of those groups assigned to the users except the groups of BOTS and AI_CRAWLERS
		$sql_ary = [
			'SELECT'	=> 'ug.group_id, g.group_type, g.group_name',

			'FROM'		=> [USER_GROUP_TABLE	=> 'ug',],

			'LEFT_JOIN'	=> [
					[
						'FROM'		=> [GROUPS_TABLE	=> 'g'],
						'ON'		=> 'g.group_id = ug.group_id',
					],
					[
						'FROM'		=> [USERS_TABLE	=> 'u'],
						'ON'		=> 'u.user_id = ug.user_id',
					],
			],

			'WHERE'		=> $this->db->sql_in_set('u.user_type', [USER_NORMAL, USER_INACTIVE]),

			'ORDER_BY'	=> 'g.group_type DESC, g.group_name ASC',
		];
		$sql = $this->db->sql_build_query('SELECT_DISTINCT', $sql_ary);
		$result = $this->db->sql_query($sql);
		$groups = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);
		$group_count = count($groups);
		$protected_groups = '';
		$protected_groups_arr = json_decode($this->config['mot_dim_protected_groups']);

		foreach ($groups as $option)
		{
			$selected = in_array($option['group_id'], $protected_groups_arr) ? ' selected' : '';
			$protected_groups .= '<option ' . (($option['group_type'] == GROUP_SPECIAL) ? ' class="sep"' : '') . ' value="' . $option['group_id'] . '"' . $selected . '>' . $this->group_helper->get_name($option['group_name']) . '</option>';
		}

		$cron_unit_select = '';
		$cron_units = [$this->language->lang('MOT_DIM_UNIT_HOUR'), $this->language->lang('MOT_DIM_UNIT_DAY')];
		for ($i = 0; $i < 2; $i++)
		{
			$selected = ($i == (int) $this->config['mot_dim_cron_unit']) ? ' selected' : '';
			$cron_unit_select .= '<option value="' . $i . '"' . $selected . '>' . $cron_units[$i] . '</option>';
		}

		$this->template->assign_vars([
			'ACP_MOT_DIM_ENABLE'					=> $this->config['mot_dim_enable'],
			'ACP_MOT_DIM_DAYS_DELETE'				=> $this->config['mot_dim_days_delete'],
			'ACP_MOT_DIM_PROTECTED_USERS'			=> $protected_users_names,
			'ACP_MOT_DIM_ENABLE_SLEEPER'			=> $this->config['mot_dim_enable_sleeper'],
			'ACP_MOT_DIM_ENABLE_ZEROPOST'			=> $this->config['mot_dim_enable_zeropost'],
			'ACP_MOT_DIM_GROUP_COUNT'				=> $group_count,
			'ACP_MOT_DIM_PROTECTED_GROUPS'			=> $protected_groups,
			'ACP_MOT_DIM_CRON_INTERVAL'				=> $this->config['mot_dim_cron_unit'] ? $this->config['mot_dim_cron_gc'] / 86400 : $this->config['mot_dim_cron_gc'] / 3600,
			'ACP_MOT_DIM_CRON_UNIT_SELECT'			=> $cron_unit_select,
			'ACP_MOT_DIM_LAST_CRON_RUN'				=> $this->config['mot_dim_cron_last_gc'] ? $this->user->format_date($this->config['mot_dim_cron_last_gc']) : '-',
			'ACP_MOT_DIM_VERSION_STRING'			=> $this->language->lang('ACP_MOT_DIM_VERSION', date('Y')),
			'U_ACTION'								=> $this->u_action . '&amp;action=submit',
			'U_ACTION_TEST_SETTINGS'				=> $this->helper->route('mot_dim_result_check_controller', []),
		]);
	}


// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	/**
	 * Set custom form action.
	 *
	 * @param	$u_action	Custom form action
	 * @return	$this		This controller for chaining calls
	 */
	public function set_page_url(string $u_action) : object
	{
		$this->u_action = $u_action;

		return $this;
	}
}
