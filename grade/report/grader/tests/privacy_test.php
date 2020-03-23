<?php
//

/**
 * Unit tests for the gradereport_grader implementation of the privacy API.
 *
 * @package    gradereport_grader
 * @category   test
 * @copyright  2018 Sara Arjona <sara@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use \core_privacy\local\metadata\collection;
use \core_privacy\local\request\writer;
use \core_privacy\local\request\approved_contextlist;
use \core_privacy\local\request\deletion_criteria;
use \gradereport_grader\privacy\provider;

/**
 * Unit tests for the gradereport_grader implementation of the privacy API.
 *
 * @copyright  2018 Sara Arjona <sara@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class gradereport_grader_privacy_testcase extends \core_privacy\tests\provider_testcase {

    /**
     * Basic setup for these tests.
     */
    public function setUp() {
        $this->resetAfterTest(true);
    }


    /**
     * Ensure that export_user_preferences returns no data if the user has no data.
     */
    public function test_export_user_preferences_not_defined() {
        $user = \core_user::get_user_by_username('admin');
        provider::export_user_preferences($user->id);

        $writer = writer::with_context(\context_system::instance());
        $this->assertFalse($writer->has_any_data());
    }

    /**
     * Ensure that export_user_preferences returns single preferences.
     * These preferences can be set on each course, but the value is shared in the whole site.
     */
    public function test_export_user_preferences_single() {
        // Add some user preferences.
        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);
        set_user_preference('grade_report_showcalculations', 1, $user);
        set_user_preference('grade_report_meanselection', GRADE_REPORT_MEAN_GRADED, $user);
        set_user_preference('grade_report_studentsperpage', 50, $user);

        // Validate exported data.
        provider::export_user_preferences($user->id);
        $context = context_user::instance($user->id);
        $writer = writer::with_context($context);
        $this->assertTrue($writer->has_any_data());
        $prefs = $writer->get_user_preferences('gradereport_grader');
        $this->assertCount(3, (array) $prefs);
        $this->assertEquals(
            get_string('privacy:metadata:preference:grade_report_showcalculations', 'gradereport_grader'),
            $prefs->grade_report_showcalculations->description
        );
        $this->assertEquals(get_string('meangraded', 'grades'), $prefs->grade_report_meanselection->value);
        $this->assertEquals(50, $prefs->grade_report_studentsperpage->value);
    }

    /**
     * Ensure that export_user_preferences returns preferences.
     */
    public function test_export_user_preferences_multiple() {
        // Create a course and add a user preference.
        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);
        $course = $this->getDataGenerator()->create_course();
        $collapsed = serialize(['aggregatesonly' => array(), 'gradesonly' => array()]);
        set_user_preference('grade_report_grader_collapsed_categories'.$course->id, $collapsed, $user);

        // Validate exported data.
        provider::export_user_preferences($user->id);
        $context = context_user::instance($user->id);
        $writer = writer::with_context($context);
        $this->assertTrue($writer->has_any_data());
        $prefs = $writer->get_user_preferences('gradereport_grader');
        $this->assertCount(1, (array) $prefs);
        $this->assertEquals(
            get_string('privacy:request:preference:grade_report_grader_collapsed_categories', 'gradereport_grader', ['name' => $course->fullname]),
            $prefs->grade_report_grader_collapsed_categories->description
        );
    }
}
