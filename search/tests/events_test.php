<?php
//

/**
 * Unit tests for search events.
 *
 * @package    core_search
 * @category   phpunit
 * @copyright  2016 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Unit tests for search events.
 *
 * @package    core_search
 * @category   phpunit
 * @copyright  2016 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_search_events_testcase extends advanced_testcase {

    /**
     * test_search_results_viewed
     *
     * @return void
     */
    public function test_search_results_viewed() {

        $this->resetAfterTest();

        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);

        $sink = $this->redirectEvents();

        // Basic event.
        \core_search\manager::trigger_search_results_viewed([
            'q' => 'I am a query',
            'page' => 0,
        ]);

        $events = $sink->get_events();
        $event = reset($events);
        $sink->clear();

        $this->assertEquals(context_system::instance(), $event->get_context());

        $urlparams = ['q' => 'I am a query', 'page' => 0];
        $this->assertEquals($urlparams, $event->get_url()->params());

        \core_search\manager::trigger_search_results_viewed([
            'q' => 'I am a query',
            'page' => 2,
            'title' => 'I am the title',
            'areaids' => array(3,4,5),
            'courseids' => array(2,3),
            'timestart' => 1445644800,
            'timeend' => 1477267200
        ]);

        $events = $sink->get_events();
        $event = reset($events);
        $this->assertEquals(context_system::instance(), $event->get_context());

        $urlparams = ['q' => 'I am a query', 'page' => 2, 'title' => 'I am the title', 'timestart' => 1445644800, 'timeend' => 1477267200];
        $this->assertEquals($urlparams, $event->get_url()->params());

    }
}