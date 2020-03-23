<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_choice
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Restore date tests.
 *
 * @package    mod_choice
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_choice_restore_date_testcase extends restore_date_testcase {

    public function test_restore_dates() {
        global $DB, $USER;

        $time = 100000;
        $record = ['timeopen' => $time, 'timeclose' => $time + 1];
        list($course, $choice) = $this->create_course_and_module('choice', $record);

        $options = $DB->get_records('choice_options', ['choiceid' => $choice->id]);
        $DB->set_field('choice_options', 'timemodified', $time);
        $option = reset($options);
        $cm = $DB->get_record('course_modules', ['id' => $choice->cmid]);
        choice_user_submit_response($option->id, $choice, $USER->id, $course, $cm);
        $answer = $DB->get_record('choice_answers', ['choiceid' => $choice->id]);

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newchoice = $DB->get_record('choice', ['course' => $newcourseid]);
        $newoptions = $DB->get_records('choice_options', ['choiceid' => $newchoice->id]);

        $this->assertFieldsNotRolledForward($choice, $newchoice, ['timemodified']);
        $props = ['timeopen', 'timeclose'];
        $this->assertFieldsRolledForward($choice, $newchoice, $props);

        // Options check.
        foreach ($newoptions as $newoption) {
            $this->assertEquals($time, $newoption->timemodified);
        }

        // Answers check.
        $newanswer = $DB->get_record('choice_answers', ['choiceid' => $newchoice->id]);
        $this->assertEquals($answer->timemodified, $newanswer->timemodified);
    }
}
