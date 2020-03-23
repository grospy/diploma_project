<?php
//

/**
 * Scheduled task to delete files and update statuses of expired data requests.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_dataprivacy\task;

use coding_exception;
use core\task\scheduled_task;
use tool_dataprivacy\api;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/' . $CFG->admin . '/tool/dataprivacy/lib.php');

/**
 * Scheduled task to delete files and update request statuses once they expire.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Michael Hawkins
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class delete_expired_requests extends scheduled_task {

    /**
     * Returns the task name.
     *
     * @return string
     */
    public function get_name() {
        return get_string('deleteexpireddatarequeststask', 'tool_dataprivacy');
    }

    /**
     * Run the task to delete expired data request files and update request statuses.
     *
     */
    public function execute() {
        $expiredrequests = \tool_dataprivacy\data_request::get_expired_requests();
        $deletecount = count($expiredrequests);

        if ($deletecount > 0) {
            \tool_dataprivacy\data_request::expire($expiredrequests);

            mtrace($deletecount . ' expired completed data requests have been deleted');
        }
    }
}
