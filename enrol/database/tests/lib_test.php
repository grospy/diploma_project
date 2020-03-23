<?php
//

/**
 * Database enrolment tests.
 *
 * @package    enrol_database
 * @copyright  2017 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Database enrolment tests.
 *
 * @package    enrol_database
 * @copyright  2017 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_database_lib_testcase extends advanced_testcase {
    /**
     * Test for getting user enrolment actions.
     */
    public function test_get_user_enrolment_actions() {
        global $CFG, $PAGE;
        $this->resetAfterTest();

        // Set page URL to prevent debugging messages.
        $PAGE->set_url('/enrol/editinstance.php');

        $pluginname = 'database';

        // Only enable the database enrol plugin.
        $CFG->enrol_plugins_enabled = $pluginname;

        $generator = $this->getDataGenerator();

        // Get the enrol plugin.
        $plugin = enrol_get_plugin($pluginname);

        // Create a course.
        $course = $generator->create_course();
        // Enable this enrol plugin for the course.
        $plugin->add_instance($course);

        // Create a student.
        $student = $generator->create_user();
        // Enrol the student to the course.
        $generator->enrol_user($student->id, $course->id, 'student', $pluginname);

        // Teachers don't have enrol/database:unenrol capability by default. Login as admin for simplicity.
        $this->setAdminUser();
        require_once($CFG->dirroot . '/enrol/locallib.php');
        $manager = new course_enrolment_manager($PAGE, $course);
        $userenrolments = $manager->get_user_enrolments($student->id);
        $this->assertCount(1, $userenrolments);

        $ue = reset($userenrolments);
        $actions = $plugin->get_user_enrolment_actions($manager, $ue);
        // Database enrol has 0 enrol actions for active users.
        $this->assertCount(0, $actions);

        // Enrol actions for a suspended student.
        // Suspend the student.
        $ue->status = ENROL_USER_SUSPENDED;

        $actions = $plugin->get_user_enrolment_actions($manager, $ue);
        // Database enrol has enrol actions for suspended students -- unenrol.
        $this->assertCount(1, $actions);
    }
}
