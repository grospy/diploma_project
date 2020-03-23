<?php
//

/**
 * Sync users task
 * @package   auth_db
 * @author    Guy Thomas <gthomas@moodlerooms.com>
 * @copyright Copyright (c) 2017 Blackboard Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_db\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Sync users task class
 * @package   auth_db
 * @author    Guy Thomas <gthomas@moodlerooms.com>
 * @copyright Copyright (c) 2017 Blackboard Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_users extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('auth_dbsyncuserstask', 'auth_db');
    }

    /**
     * Run task for synchronising users.
     */
    public function execute() {
        if (!is_enabled_auth('db')) {
            mtrace('auth_db plugin is disabled, synchronisation stopped', 2);
            return;
        }

        $dbauth = get_auth_plugin('db');
        $config = get_config('auth_db');
        $trace = new \text_progress_trace();
        $update = !empty($config->updateusers);
        $dbauth->sync_users($trace, $update);
    }

}
