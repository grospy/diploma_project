<?php
//

/**
 * Tests that completion works without requiring unnecessary capabilities.
 *
 * @package    core_completion
 * @copyright  2018 University of Nottingham
 * @author     Neill Magill <neill.magill@nottingham.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Tests that completion works without requiring unnecessary capabilities.
 *
 * @package    core_completion
 * @copyright  2018 University of Nottingham
 * @author     Neill Magill <neill.magill@nottingham.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_completion_capabilities_testcase extends advanced_testcase {
    /**
     * A user who does not have capabilities to add events to the calendar should be able to create activities.
     */
    public function test_creation_with_no_calendar_capabilities() {
        $this->resetAfterTest();
        $course = self::getDataGenerator()->create_course(['enablecompletion' => 1]);
        $context = context_course::instance($course->id);
        $user = self::getDataGenerator()->create_and_enrol($course, 'editingteacher');
        $roleid = self::getDataGenerator()->create_role();
        self::getDataGenerator()->role_assign($roleid, $user->id, $context->id);
        assign_capability('moodle/calendar:manageentries', CAP_PROHIBIT, $roleid, $context, true);
        $generator = self::getDataGenerator()->get_plugin_generator('mod_forum');
        // Create an instance as a user without the calendar capabilities.
        $this->setUser($user);
        $params = array(
            'course' => $course->id,
            'completionexpected' => time() + 2000,
        );
        $generator->create_instance($params);
    }
}
