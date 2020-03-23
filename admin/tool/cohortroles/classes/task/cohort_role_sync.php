<?php
//

/**
 * Scheduled task for syncing cohort roles.
 *
 * @package    tool_cohortroles
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_cohortroles\task;

use core\task\scheduled_task;
use tool_cohortroles\api;

/**
 * Scheduled task for syncing cohort roles.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cohort_role_sync extends scheduled_task {

    /**
     * Get name.
     * @return string
     */
    public function get_name() {
        // Shown in admin screens.
        return get_string('taskname', 'tool_cohortroles');
    }

    /**
     * Execute.
     */
    public function execute() {
        mtrace('Sync cohort roles...');
        $result = api::sync_all_cohort_roles();

        mtrace('Added ' . count($result['rolesadded']));
        mtrace('Removed ' . count($result['rolesremoved']));
    }
}
