<?php
//

/**
 * Tests for question instances events.
 *
 * @package    report_questioninstances
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class for question instances events.
 *
 * @package    report_questioninstances
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class report_questioninstances_events_testcase extends advanced_testcase {

    /**
     * Setup testcase.
     */
    public function setUp() {
        $this->setAdminUser();
        $this->resetAfterTest();
    }

    /**
     * Test the report viewed event.
     */
    public function test_report_viewed() {
        $requestedqtype = 'all';
        $event = \report_questioninstances\event\report_viewed::create(array('other' => array('requestedqtype' => $requestedqtype)));

        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);

        $this->assertInstanceOf('\report_questioninstances\event\report_viewed', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
        $expected = array(SITEID, "admin", "report questioninstances", "report/questioninstances/index.php?qtype=$requestedqtype", $requestedqtype);
        $this->assertEventLegacyLogData($expected, $event);
        $this->assertEventContextNotUsed($event);
        $url = new moodle_url('/report/questioninstances/index.php', array('qtype' => $requestedqtype));
        $this->assertEquals($url, $event->get_url());
        $event->get_name();
    }
}
