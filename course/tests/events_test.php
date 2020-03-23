<?php
//

/**
 * This file contains the class that handles testing of course events.
 *
 * @package core
 * @copyright  2016 Stephen Bourget
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * This file contains the class that handles testing of course events.
 *
 * @package core_course
 * @copyright  2016 Stephen Bourget
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_course_events_testcase extends advanced_testcase {

    /**
     * Tests set up
     */
    protected function setUp() {
        global $CFG;
        require_once($CFG->dirroot . '/course/lib.php');
        $this->resetAfterTest();
    }

    /**
     * Test the course category viewed.
     *
     * There is no external API for viewing a category, so the unit test will simply
     * create and trigger the event and ensure data is returned as expected.
     */
    public function test_course_category_viewed_event() {

        // Create a category.
        $category = $this->getDataGenerator()->create_category();

        // Trigger an event: course category viewed.
        $eventparams = array(
            'objectid' => $category->id,
            'context' => context_system::instance(),
        );

        $event = \core\event\course_category_viewed::create($eventparams);
        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);

        // Check that the event data is valid.
        $this->assertInstanceOf('\core\event\course_category_viewed', $event);
        $this->assertEquals($category->id, $event->objectid);
        $this->assertDebuggingNotCalled();
        $sink->close();

    }

    /**
     * Test the course information viewed.
     *
     * There is no external API for viewing course information so the unit test will simply
     * create and trigger the event and ensure data is returned as expected.
     */
    public function test_course_information_viewed_event() {

        // Create a course.
        $data = new stdClass();
        $course = $this->getDataGenerator()->create_course($data);

        // Trigger an event: course category viewed.
        $eventparams = array(
            'objectid' => $course->id,
            'context' => context_course::instance($course->id),
        );

        $event = \core\event\course_information_viewed::create($eventparams);
        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);

        // Check that the event data is valid.
        $this->assertInstanceOf('\core\event\course_information_viewed', $event);
        $this->assertEquals($course->id, $event->objectid);
        $this->assertDebuggingNotCalled();
        $sink->close();

    }

    /**
     * Test the courses searched.
     *
     * There is no external API for viewing course information so the unit test will simply
     * create and trigger the event and ensure data is returned as expected.
     */
    public function test_courses_searched_event() {

        // Trigger an event: courses searched.
        $search = 'mysearch';
        $eventparams = array(
            'context' => context_system::instance(),
            'other' => array('query' => $search)
        );

        $event = \core\event\courses_searched::create($eventparams);
        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);

        // Check that the event data is valid.
        $this->assertInstanceOf('\core\event\courses_searched', $event);
        $this->assertEquals($search, $event->other['query']);
        $this->assertDebuggingNotCalled();
        $sink->close();

    }
}
