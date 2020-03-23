<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_feedback
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Restore date tests.
 *
 * @package    mod_feedback
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_feedback_restore_date_testcase extends restore_date_testcase {

    public function test_restore_dates() {
        global $DB, $USER;

        $time = 10000;
        list($course, $feedback) = $this->create_course_and_module('feedback', ['timeopen' => $time, 'timeclose' => $time]);

        // Create response.
        $response = new stdClass();
        $response->feedback = $feedback->id;
        $response->userid = $USER->id;
        $response->anonymous_response = FEEDBACK_ANONYMOUS_NO;
        $response->timemodified = $time;
        $completedid = $DB->insert_record('feedback_completed', $response);
        $response = $DB->get_record('feedback_completed', array('id' => $completedid), '*', MUST_EXIST);

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newfeedback = $DB->get_record('feedback', ['course' => $newcourseid]);
        $newresponse = $DB->get_record('feedback_completed', ['feedback' => $newfeedback->id]);

        $this->assertFieldsNotRolledForward($feedback, $newfeedback, ['timemodified']);
        $props = ['timeopen', 'timeclose'];
        $this->assertFieldsRolledForward($feedback, $newfeedback, $props);
        $this->assertEquals($response->timemodified, $newresponse->timemodified);
    }
}
