<?php
//

/**
 * Restore override tests.
 *
 * @package    mod_lesson
 * @author   2019 Nathan Nguyen <nathannguyen@catalyst-au.net>
 * @copyright Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");
/**
 * Restore override tests.
 *
 * @package    mod_lesson
 * @author   2019 Nathan Nguyen <nathannguyen@catalyst-au.net>
 * @copyright Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_lesson_restore_override_testcase extends restore_date_testcase {

    /**
     * Test restore overrides.
     */
    public function test_restore_overrides() {
        global $DB, $USER;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $lessongen = $this->getDataGenerator()->get_plugin_generator('mod_lesson');
        $lesson = $lessongen->create_instance(['course' => $course->id]);

        $group1 = $this->getDataGenerator()->create_group(array('courseid' => $course->id));
        $group2 = $this->getDataGenerator()->create_group(array('courseid' => $course->id));

        $now = 100;
        $groupoverride1 = (object)[
            'lessonid' => $lesson->id,
            'groupid' => $group1->id,
            'available' => $now,
            'deadline' => $now + 20
        ];
        $DB->insert_record('lesson_overrides', $groupoverride1);

        $groupoverride2 = (object)[
            'lessonid' => $lesson->id,
            'groupid' => $group2->id,
            'available' => $now,
            'deadline' => $now + 40
        ];
        $DB->insert_record('lesson_overrides', $groupoverride2);

        // Current quiz overrides.
        $overrides = $DB->get_records('lesson_overrides', ['lessonid' => $lesson->id]);
        $this->assertEquals(2, count($overrides));

        // User override.
        $useroverride = (object)[
            'lessonid' => $lesson->id,
            'userid' => $USER->id,
            'sortorder' => 1,
            'available' => 100,
            'deadline' => 200
        ];
        $DB->insert_record('lesson_overrides', $useroverride);

        // Current quiz overrides.
        $overrides = $DB->get_records('lesson_overrides', ['lessonid' => $lesson->id]);
        $this->assertEquals(3, count($overrides));

        // Back up and restore including group info and user info.
        set_config('backup_general_groups', 1, 'backup');
        $newcourseid = $this->backup_and_restore($course);
        $newquiz = $DB->get_record('lesson', ['course' => $newcourseid]);
        $overrides = $DB->get_records('lesson_overrides', ['lessonid' => $newquiz->id]);
        // 2 groups overrides and 1 user override.
        $this->assertEquals(3, count($overrides));

        // Back up and restore with user info and without group info.
        set_config('backup_general_groups', 0, 'backup');
        $newcourseid = $this->backup_and_restore($course);
        $newquiz = $DB->get_record('lesson', ['course' => $newcourseid]);
        $overrides = $DB->get_records('lesson_overrides', ['lessonid' => $newquiz->id]);
        // 1 user override.
        $this->assertEquals(1, count($overrides));
    }
}
