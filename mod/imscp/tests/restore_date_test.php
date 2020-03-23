<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_imscp
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Restore date tests.
 *
 * @package    mod_imscp
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_imscp_restore_date_testcase extends restore_date_testcase {

    public function test_restore_dates() {
        global $DB;

        list($course, $imscp) = $this->create_course_and_module('imscp');

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newimscp = $DB->get_record('imscp', ['course' => $newcourseid]);
        $this->assertFieldsNotRolledForward($imscp, $newimscp, ['timemodified']);
    }
}
