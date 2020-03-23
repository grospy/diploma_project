<?php
//

/**
 * Unit test for mod_survey searching.
 *
 * This is needed because the activity.php class overrides default behaviour.
 *
 * @package mod_survey
 * @category test
 * @copyright 2017 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Unit test for mod_survey searching.
 *
 * This is needed because the activity.php class overrides default behaviour.
 *
 * @package mod_survey
 * @category test
 * @copyright 2017 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_survey_search_testcase extends advanced_testcase {

    /**
     * Test survey_view
     * @return void
     */
    public function test_survey_indexing() {
        global $CFG;

        $this->resetAfterTest();

        require_once($CFG->dirroot . '/search/tests/fixtures/testable_core_search.php');
        testable_core_search::instance();
        $area = \core_search\manager::get_search_area('mod_survey-activity');

        // Setup test data.
        $generator = $this->getDataGenerator();
        $course = $generator->create_course();
        $survey1 = $generator->create_module('survey', ['course' => $course->id]);
        $survey2 = $generator->create_module('survey', ['course' => $course->id]);

        // Get all surveys for indexing - note that there are special entries in the table with
        // course zero which should not be returned.
        $rs = $area->get_document_recordset();
        $this->assertEquals(2, iterator_count($rs));
        $rs->close();

        // Test specific context and course context.
        $rs = $area->get_document_recordset(0, context_module::instance($survey1->cmid));
        $this->assertEquals(1, iterator_count($rs));
        $rs->close();
        $rs = $area->get_document_recordset(0, context_course::instance($course->id));
        $this->assertEquals(2, iterator_count($rs));
        $rs->close();
    }
}
