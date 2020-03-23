<?php
//

/**
 * Action factory test.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use core_calendar\action_factory;
use core_calendar\local\event\entities\action_interface;

/**
 * Action factory testcase.
 *
 * @copyright 2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_calendar_action_factory_test extends advanced_testcase {
    /**
     * Test action factory.
     */
    public function test_action_factory() {
        $factory = new action_factory();
        $instance = $factory->create_instance(
            'test',
            new \moodle_url('http://example.com'),
            1729,
            true
        );

        $this->assertInstanceOf(action_interface::class, $instance);
    }
}
