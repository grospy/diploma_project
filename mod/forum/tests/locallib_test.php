<?php
//

/**
 * File containing the forum module local library function tests.
 *
 * @package    mod_forum
 * @category   test
 * @copyright  2018 Shamim Rezaie <shamim@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/forum/lib.php');

/**
 * Class mod_forum_locallib_testcase.
 *
 * @copyright  2018 Shamim Rezaie <shamim@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_forum_locallib_testcase extends advanced_testcase {
    public function test_forum_update_calendar() {
        global $DB;

        $this->resetAfterTest();

        $this->setAdminUser();

        // Create a course.
        $course = $this->getDataGenerator()->create_course();

        // Create a forum activity.
        $time = time();
        $forum = $this->getDataGenerator()->create_module('forum',
                array(
                    'course' => $course->id,
                    'duedate' => $time
                )
        );

        // Check that there is now an event in the database.
        $events = $DB->get_records('event');
        $this->assertCount(1, $events);

        // Get the event.
        $event = reset($events);

        // Confirm the event is correct.
        $this->assertEquals('forum', $event->modulename);
        $this->assertEquals($forum->id, $event->instance);
        $this->assertEquals(CALENDAR_EVENT_TYPE_ACTION, $event->type);
        $this->assertEquals(FORUM_EVENT_TYPE_DUE, $event->eventtype);
        $this->assertEquals($time, $event->timestart);
        $this->assertEquals($time, $event->timesort);
    }
}