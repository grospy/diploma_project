<?php
//

/**
 * coursecat_proxy tests.
 *
 * @package     core_calendar
 * @copyright   2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use core_calendar\local\event\proxies\coursecat_proxy;

/**
 * coursecat_proxy testcase.
 *
 * @copyright   2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_calendar_coursecat_proxy_testcase extends advanced_testcase {

    public function test_valid_coursecat() {
        global $DB;
        $this->resetAfterTest();

        $name = '2027-2028 Academic Year';
        $generator = $this->getDataGenerator();
        $category = $generator->create_category([
                'name' => $name,
            ]);
        cache_helper::purge_by_event('changesincoursecat');

        // Fetch the proxy.
        $startreads = $DB->perf_get_reads();
        $proxy = new coursecat_proxy($category->id);
        $this->assertInstanceOf(coursecat_proxy::class, $proxy);
        $this->assertEquals(0, $DB->perf_get_reads() - $startreads);

        // Fetch the ID - this is known and doesn't require a cache read.
        $this->assertEquals($category->id, $proxy->get('id'));
        $this->assertEquals(0, $DB->perf_get_reads() - $startreads);

        // Fetch the name - not known, and requires a read.
        $this->assertEquals($name, $proxy->get('name'));
        $this->assertEquals(1, $DB->perf_get_reads() - $startreads);

        $this->assertInstanceOf('core_course_category', $proxy->get_proxied_instance());
    }
}
