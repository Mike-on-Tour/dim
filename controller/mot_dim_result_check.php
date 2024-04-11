<?php
/**
*
* @package MoT DIM v0.2.0
* @copyright (c) 2024 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\dim\controller;

class mot_dim_result_check
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\language\language $language Language object */
	protected $language;

	/** @var \phpbb\pagination  */
	protected $pagination;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/* @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\controller\helper $helper, \phpbb\language\language $language,
								\phpbb\pagination $pagination, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->config = $config;
		$this->db = $db;
		$this->helper = $helper;
		$this->language = $language;
		$this->pagination = $pagination;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
	}

	public function main()
	{
		// set parameters for pagination
		$start = $this->request->variable('start', 0);
		$limit = 25;

		// Compute the threshold timestamp
		$threshold = time() - ($this->config['mot_dim_days_delete'] * 86400);

		// Get the protected users and groups
		$protected_users = json_decode($this->config['mot_dim_protected_users']);
		$protected_groups = json_decode($this->config['mot_dim_protected_groups']);

		$sql_ary = [
			'SELECT'		=> 'u.user_id, u.username, u.user_type, u.group_id, u.user_regdate, g.group_type, g.group_name',

			'FROM'			=> [USERS_TABLE		=> 'u',],

			'LEFT_JOIN'		=> [
						[
							'FROM'		=> [GROUPS_TABLE		=> 'g'],
							'ON'		=> 'g.group_id = u.group_id',
						],
			],

			'WHERE'			=> '((u.user_type = '. USER_INACTIVE . ' AND u.user_inactive_reason = ' . INACTIVE_REGISTER . ' AND u.user_regdate < ' . (int) $threshold . ') OR
									(u.user_type = '. USER_NORMAL . ' AND u.user_lastvisit = 0 AND u.user_regdate < ' . (int) $threshold . ') OR
									(u.user_type = '. USER_NORMAL . ' AND u.user_lastvisit > 0 AND u.user_posts = 0 AND u.user_regdate < ' . (int) $threshold . ')
								)' .
								(!empty($protected_users) ? ' AND (' . $this->db->sql_in_set('u.user_id', $protected_users, true) . ')' : '') .
								(!empty($protected_groups) ? ' AND (' . $this->db->sql_in_set('u.group_id', $protected_groups, true) . ')' : ''),

			'ORDER_BY'		=> 'u.user_id ASC',
		];
		$sql = $this->db->sql_build_query('SELECT', $sql_ary);
		$result = $this->db->sql_query($sql);
		$user_result = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		// Get the total users count
		$total_users = count($user_result);

		// And now do the query with the pagination values
		$result = $this->db->sql_query_limit($sql, $limit, $start);
		$user_result = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		// Prepare table content
		foreach ($user_result as $row)
		{
			$this->template->assign_block_vars('users', [
				'USERNAME'		=> $row['username'],
				'GROUP'			=> $row['group_type'] == GROUP_SPECIAL ? $this->language->lang('G_' . $row['group_name']) : $row['group_name'],
				'REG_DATE'		=> $this->user->format_date($row['user_regdate']),
				'INACTIVE'		=> $row['user_type'] == USER_INACTIVE ? 'X' : '',
			]);
		}

		//base url for pagination
		$base_url = $this->helper->route('mot_dim_result_check_controller');

		// Load pagination
		$start = $this->pagination->validate_start($start, $limit, $total_users);
		$this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $total_users, $limit, $start);

		$this->template->assign_vars([
			'MOT_DIM_TOTAL_USERS'		=> $this->language->lang('MOT_DIM_TOTAL_USERS', $total_users),
		]);

		// output page
		page_header($this->language->lang('MOT_DIM_CHECK_RESULT'));

		$this->template->set_filenames([
			'body' => 'mot_dim_result_check.html',
		]);

		page_footer();
	}
}
