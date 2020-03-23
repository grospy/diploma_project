<?php
//

/**
 * Meta sync enrolments task.
 *
 * @package   enrol_meta
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_meta\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Meta sync enrolments task.
 *
 * @package   enrol_meta
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_meta_sync extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('enrolmetasynctask', 'enrol_meta');
    }

    /**
     * Run task for syncing meta enrolments.
     */
    public function execute() {
        global $CFG;
        require_once("$CFG->dirroot/enrol/meta/locallib.php");
        enrol_meta_sync();
    }

}
