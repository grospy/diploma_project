<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_folder
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Restore date tests.
 *
 * @package    mod_folder
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_folder_restore_date_testcase extends restore_date_testcase {

    public function test_restore_dates() {
        global $DB;

        list($course, $folder) = $this->create_course_and_module('folder');

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newfolder = $DB->get_record('folder', ['course' => $newcourseid]);
        $this->assertFieldsNotRolledForward($folder, $newfolder, ['timemodified']);
    }
}
