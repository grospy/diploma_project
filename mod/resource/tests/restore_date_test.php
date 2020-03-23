<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_resource
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Restore date tests.
 *
 * @package    mod_resource
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_resource_restore_date_testcase extends restore_date_testcase {

    public function test_restore_dates() {
        global $DB;

        $time = 10000;

        list($course, $resource) = $this->create_course_and_module('resource');

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newresource = $DB->get_record('resource', ['course' => $newcourseid]);
        $this->assertFieldsNotRolledForward($resource, $newresource, ['timemodified']);
    }
}
