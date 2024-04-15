<?php
/**
*
* @package MoT DIM v1.0.0
* @copyright (c) 2024 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\dim\cron\task;

class mot_dim_cron extends \phpbb\cron\task\base
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\log\log $log */
	protected $log;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB phpbb root path */
	protected $root_path;

	/** @var string PHP extension */
	protected $phpEx;

	/**
	 * {@inheritdoc
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\log\log $log, \phpbb\user $user, $root_path, $phpEx)
	{
		$this->config = $config;
		$this->db = $db;
		$this->log = $log;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->phpEx = $phpEx;
	}

	/**
	* Runs this cron task.
	*
	* @return null
	*/
	public function run()
	{
		$this->check_users_to_delete();
	}

	/**
	* Returns whether this cron task can run, given current board configuration.
	*
	* @return bool
	*/
	public function is_runnable()
	{
		return true;
	}

	/**
	* Returns whether this cron task should run now, because enough time
	* has passed since it was last run.
	*
	* The interval between topics tidying is specified in extension
	* configuration.
	*
	* @return bool
	*/
	public function should_run()
	{
		return $this->config['mot_dim_cron_last_gc'] < time() - $this->config['mot_dim_cron_gc'];
	}

/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

	private function check_users_to_delete()
	{
		// Check if extension is active
		if ($this->config['mot_dim_enable'])
		{
			// Compute the threshold timestamp
			$threshold = time() - ($this->config['mot_dim_days_delete'] * 86400);

			// Get the protected users and groups
			$protected_users = json_decode($this->config['mot_dim_protected_users']);
			$protected_groups = json_decode($this->config['mot_dim_protected_groups']);

			$sql_ary = [
				'SELECT'		=> 'u.user_id',

				'FROM'			=> [USERS_TABLE	=> 'u'],

				'WHERE'			=> '(
										(u.user_type = '. USER_INACTIVE . ' AND u.user_inactive_reason = ' . INACTIVE_REGISTER . ')' .
										($this->config['mot_dim_enable_sleeper'] ? ' OR (u.user_type = '. USER_NORMAL . ' AND u.user_lastvisit = 0)' : '') .
										($this->config['mot_dim_enable_zeropost'] ? ' OR (u.user_type = '. USER_NORMAL . ' AND u.user_lastvisit > 0 AND u.user_posts = 0)' : '') . '
									)
									AND u.user_regdate < ' . (int) $threshold .
									(!empty($protected_users) ? ' AND (' . $this->db->sql_in_set('u.user_id', $protected_users, true) . ')' : '') .
									(!empty($protected_groups) ? ' AND (' . $this->db->sql_in_set('u.group_id', $protected_groups, true) . ')' : ''),
			];
			$sql = $this->db->sql_build_query('SELECT', $sql_ary);
			// Add a LIMIT to the query to ascertain that following queries using the IN clause do not abort because of too many user_ids to handle (an internet search revealed that 1000 seems to be the limit)
			$sql .= ' LIMIT 1000';
			$result = $this->db->sql_query($sql);
			$user_id_result = $this->db->sql_fetchrowset($result);
			$this->db->sql_freeresult($result);

			// Check if we have any users to delete
			if ($user_id_result)
			{
				// Reformat the array holding the users
				$user_ids = [];
				foreach ($user_id_result as $row)
				{
					$user_ids[] = (int) $row['user_id'];
				}

				// Check whether the phpBB function to handle user deletion is available and load it if not
				if (!function_exists('user_delete'))
				{
					include($this->root_path . 'includes/functions_user.' . $this->phpEx);
				}

				user_delete('retain', $user_ids);

				// Log the action
				$username_ary = [];
				user_get_id_name($user_ids, $username_ary);
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'MOT_DIM_LOG_DELETION', false, [implode(', ', $username_ary)]);
			}

			// Set the last run config variable
			$this->config->set('mot_dim_cron_last_gc', time());
		}
	}
}
