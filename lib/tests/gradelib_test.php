<?php
//

/**
 * Unit tests for /lib/gradelib.php.
 *
 * @package   core_grades
 * @category  phpunit
 * @copyright 2012 Andrew Davis
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/gradelib.php');

class core_gradelib_testcase extends advanced_testcase {

    public function test_grade_update_mod_grades() {

        $this->resetAfterTest(true);

        // Create a broken module instance.
        $modinstance = new stdClass();
        $modinstance->modname = 'doesntexist';

        $this->assertFalse(grade_update_mod_grades($modinstance));
        // A debug message should have been generated.
        $this->assertDebuggingCalled();

        // Create a course and instance of mod_assign.
        $course = $this->getDataGenerator()->create_course();

        $assigndata['course'] = $course->id;
        $assigndata['name'] = 'lightwork assignment';
        $modinstance = self::getDataGenerator()->create_module('assign', $assigndata);

        // Function grade_update_mod_grades() requires 2 additional properties, cmidnumber and modname.
        $cm = get_coursemodule_from_instance('assign', $modinstance->id, 0, false, MUST_EXIST);
        $modinstance->cmidnumber = $cm->id;
        $modinstance->modname = 'assign';

        $this->assertTrue(grade_update_mod_grades($modinstance));
    }

    /**
     * Tests the function remove_grade_letters().
     */
    public function test_remove_grade_letters() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();

        $context = context_course::instance($course->id);

        // Add a grade letter to the course.
        $letter = new stdClass();
        $letter->letter = 'M';
        $letter->lowerboundary = '100';
        $letter->contextid = $context->id;
        $DB->insert_record('grade_letters', $letter);

        remove_grade_letters($context, false);

        // Confirm grade letter was deleted.
        $this->assertEquals(0, $DB->count_records('grade_letters'));
    }

    /**
     * Tests the function grade_course_category_delete().
     */
    public function test_grade_course_category_delete() {
        global $DB;

        $this->resetAfterTest();

        $category = core_course_category::create(array('name' => 'Cat1'));

        // Add a grade letter to the category.
        $letter = new stdClass();
        $letter->letter = 'M';
        $letter->lowerboundary = '100';
        $letter->contextid = context_coursecat::instance($category->id)->id;
        $DB->insert_record('grade_letters', $letter);

        grade_course_category_delete($category->id, '', false);

        // Confirm grade letter was deleted.
        $this->assertEquals(0, $DB->count_records('grade_letters'));
    }

    /**
     * Tests the function grade_regrade_final_grades().
     */
    public function test_grade_regrade_final_grades() {
        global $DB;

        $this->resetAfterTest();

        // Setup some basics.
        $course = $this->getDataGenerator()->create_course();
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');

        // We need two grade items.
        $params = ['idnumber' => 'g1', 'courseid' => $course->id];
        $g1 = new grade_item($this->getDataGenerator()->create_grade_item($params));
        unset($params['idnumber']);
        $g2 = new grade_item($this->getDataGenerator()->create_grade_item($params));

        $category = new grade_category($this->getDataGenerator()->create_grade_category($params));
        $catitem = $category->get_grade_item();

        // Now set a calculation.
        $catitem->set_calculation('=[[g1]]');

        $catitem->update();

        // Everything needs updating.
        $this->assertEquals(4, $DB->count_records('grade_items', ['courseid' => $course->id, 'needsupdate' => 1]));

        grade_regrade_final_grades($course->id);

        // See that everything has been updated.
        $this->assertEquals(0, $DB->count_records('grade_items', ['courseid' => $course->id, 'needsupdate' => 1]));

        $g1->delete();

        // Now there is one that needs updating.
        $this->assertEquals(1, $DB->count_records('grade_items', ['courseid' => $course->id, 'needsupdate' => 1]));

        // This can cause an infinite loop if things go... poorly.
        grade_regrade_final_grades($course->id);

        // Now because of the failure, two things need updating.
        $this->assertEquals(2, $DB->count_records('grade_items', ['courseid' => $course->id, 'needsupdate' => 1]));
    }

    /**
     * Tests for the grade_get_date_for_user_grade function.
     *
     * @dataProvider grade_get_date_for_user_grade_provider
     * @param stdClass $grade
     * @param stdClass $user
     * @param int $expected
     */
    public function test_grade_get_date_for_user_grade(stdClass $grade, stdClass $user, ?int $expected): void {
        $this->assertEquals($expected, grade_get_date_for_user_grade($grade, $user));
    }

    /**
     * Data provider for tests of the grade_get_date_for_user_grade function.
     *
     * @return array
     */
    public function grade_get_date_for_user_grade_provider(): array {
        $u1 = (object) [
            'id' => 42,
        ];
        $u2 = (object) [
            'id' => 930,
        ];

        $d1 = 1234567890;
        $d2 = 9876543210;

        $g1 = (object) [
            'usermodified' => $u1->id,
            'dategraded' => $d1,
            'datesubmitted' => $d2,
        ];
        $g2 = (object) [
            'usermodified' => $u1->id,
            'dategraded' => $d1,
            'datesubmitted' => 0,
        ];

        $g3 = (object) [
            'usermodified' => $u1->id,
            'dategraded' => null,
            'datesubmitted' => $d2,
        ];

        return [
            'If the user is the last person to have modified the grade_item then show the date that it was graded' => [
                $g1,
                $u1,
                $d1,
            ],
            'If there is no grade and there is no feedback, then show graded date as null' => [
                $g3,
                $u1,
                null,
            ],
            'If the user is not the last person to have modified the grade_item, ' .
            'and there is no submission date, then show the date that it was submitted' => [
                $g1,
                $u2,
                $d2,
            ],
            'If the user is not the last person to have modified the grade_item, ' .
            'but there is no submission date, then show the date that it was graded' => [
                $g2,
                $u2,
                $d1,
            ],
            'If the user is the last person to have modified the grade_item, ' .
            'and there is no submission date, then still show the date that it was graded' => [
                $g2,
                $u1,
                $d1,
            ],
        ];
    }
}
