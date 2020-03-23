<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_workshop
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/workshop/locallib.php');
require_once($CFG->dirroot . '/mod/workshop/lib.php');
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");
require_once($CFG->dirroot . "/mod/workshop/tests/fixtures/testable.php");

/**
 * Restore date tests.
 *
 * @package    mod_workshop
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_workshop_restore_date_testcase extends restore_date_testcase {

    /**
     * Test restore dates.
     */
    public function test_restore_dates() {
        global $DB, $USER;

        // Create workshop data.
        $record = ['submissionstart' => 100, 'submissionend' => 100, 'assessmentend' => 100, 'assessmentstart' => 100];
        list($course, $workshop) = $this->create_course_and_module('workshop', $record);
        $workshopgenerator = $this->getDataGenerator()->get_plugin_generator('mod_workshop');
        $subid = $workshopgenerator->create_submission($workshop->id, $USER->id);
        $exsubid = $workshopgenerator->create_submission($workshop->id, $USER->id, ['example' => 1]);
        $workshopgenerator->create_assessment($subid, $USER->id);
        $workshopgenerator->create_assessment($exsubid, $USER->id, ['weight' => 0]);
        $workshopgenerator->create_assessment($exsubid, $USER->id);

        // Set time fields to a constant for easy validation.
        $timestamp = 100;
        $DB->set_field('workshop_submissions', 'timecreated', $timestamp);
        $DB->set_field('workshop_submissions', 'timemodified', $timestamp);
        $DB->set_field('workshop_assessments', 'timecreated', $timestamp);
        $DB->set_field('workshop_assessments', 'timemodified', $timestamp);

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newworkshop = $DB->get_record('workshop', ['course' => $newcourseid]);

        $this->assertFieldsNotRolledForward($workshop, $newworkshop, ['timemodified']);
        $props = ['submissionstart', 'submissionend', 'assessmentend', 'assessmentstart'];
        $this->assertFieldsRolledForward($workshop, $newworkshop, $props);

        $submissions = $DB->get_records('workshop_submissions', ['workshopid' => $newworkshop->id]);
        // Workshop submission time checks.
        foreach ($submissions as $submission) {
            $this->assertEquals($timestamp, $submission->timecreated);
            $this->assertEquals($timestamp, $submission->timemodified);
            $assessments = $DB->get_records('workshop_assessments', ['submissionid' => $submission->id]);
            // Workshop assessment time checks.
            foreach ($assessments as $assessment) {
                $this->assertEquals($timestamp, $assessment->timecreated);
                $this->assertEquals($timestamp, $assessment->timemodified);
            }
        }
    }
}
