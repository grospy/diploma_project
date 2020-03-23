<?php
//

/**
 * Complete plans task.
 *
 * @package    core_competency
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;
defined('MOODLE_INTERNAL') || die();

use core_competency\api;
use core_competency\plan;

/**
 * Complete plans task class.
 *
 * This task should run relatively often because the plans due dates can be set at
 * any time of the day in any timezone.
 *
 * @package    core_competency
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class complete_plans_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('completeplanstask', 'core_competency');
    }

    /**
     * Do the job.
     */
    public function execute() {
        if (!api::is_enabled()) {
            return;
        }

        $records = plan::get_recordset_for_due_and_incomplete();
        foreach ($records as $record) {
            $plan = new plan(0, $record);
            api::complete_plan($plan);
        }
        $records->close();
    }

}
