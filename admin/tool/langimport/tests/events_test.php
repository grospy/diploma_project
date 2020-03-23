<?php
//

/**
 * Tests for langimport events.
 *
 * @package    tool_langimport
 * @copyright  2014 Dan Poltawski
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Test class for langimport events.
 *
 * @package    tool_langimport
 * @copyright  2014 Dan Poltawski
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class tool_langimport_events_testcase extends advanced_testcase {

    /**
     * Setup testcase.
     */
    public function setUp() {
        $this->setAdminUser();
        $this->resetAfterTest();
    }

    public function test_langpack_updated() {
        global $CFG;

        $event = \tool_langimport\event\langpack_updated::event_with_langcode($CFG->lang);

        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);

        $this->assertInstanceOf('\tool_langimport\event\langpack_updated', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
    }

    /**
     * @expectedException        coding_exception
     * @expectedExceptionMessage The 'langcode' value must be set to a valid language code
     */
    public function test_langpack_updated_validation() {

        \tool_langimport\event\langpack_updated::event_with_langcode('broken langcode');
    }

    public function test_langpack_installed() {
        $event = \tool_langimport\event\langpack_imported::event_with_langcode('fr');

        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);

        $this->assertInstanceOf('\tool_langimport\event\langpack_imported', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
    }

    /**
     * @expectedException        coding_exception
     * @expectedExceptionMessage The 'langcode' value must be set to a valid language code
     */
    public function test_langpack_installed_validation() {

        \tool_langimport\event\langpack_imported::event_with_langcode('broken langcode');
    }

    public function test_langpack_removed() {
        $event = \tool_langimport\event\langpack_removed::event_with_langcode('fr');

        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);

        $this->assertInstanceOf('\tool_langimport\event\langpack_removed', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
    }

    /**
     * @expectedException        coding_exception
     * @expectedExceptionMessage The 'langcode' value must be set to a valid language code
     */
    public function test_langpack_removed_validation() {

        \tool_langimport\event\langpack_removed::event_with_langcode('broken langcode');
    }
}
