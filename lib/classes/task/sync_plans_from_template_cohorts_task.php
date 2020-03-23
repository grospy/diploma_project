<?php
//

/**
 * Synchronise plans from template cohorts.
 *
 * @package    core_competency
 * @copyright  2015 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;
defined('MOODLE_INTERNAL') || die();

use core_competency\api;
use core_competency\template_cohort;

/**
 * Synchronise plans from template cohorts.
 *
 *
 * @package    core_competency
 * @copyright  2015 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_plans_from_template_cohorts_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('syncplanscohorts', 'core_competency');
    }

    /**
     * Do the job.
     */
    public function execute() {
        if (!api::is_enabled()) {
            return;
        }

        $missingplans = template_cohort::get_all_missing_plans(self::get_last_run_time());

        foreach ($missingplans as $missingplan) {
            foreach ($missingplan['userids'] as $userid) {
                try {
                    api::create_plan_from_template($missingplan['template'], $userid);
                } catch (\Exception $e) {
                    debugging(sprintf('Exception caught while creating plan for user %d from template %d. Message: %s',
                        $userid, $missingplan['template']->get_id(), $e->getMessage()), DEBUG_DEVELOPER);
                }
            }
        }
    }
}
