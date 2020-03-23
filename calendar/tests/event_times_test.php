<?php
//

/**
 * Event times tests.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use core_calendar\local\event\value_objects\event_times;

/**
 * Event times testcase.
 *
 * @copyright 2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_calendar_event_times_testcase extends advanced_testcase {
    /**
     * Test event times class getters.
     *
     * @dataProvider getters_testcases()
     * @param array $constructorparams Associative array of constructor parameters.
     */
    public function test_getters($constructorparams) {
        $eventtimes = new event_times(
            $constructorparams['start_time'],
            $constructorparams['end_time'],
            $constructorparams['sort_time'],
            $constructorparams['modified_time']
        );

        foreach ($constructorparams as $name => $value) {
            $this->assertEquals($eventtimes->{'get_' . $name}(), $value);
        }

        $this->assertEquals($eventtimes->get_duration(), $constructorparams['end_time']->diff($constructorparams['start_time']));
    }

    /**
     * Test cases for getters test.
     */
    public function getters_testcases() {
        return [
            'Dataset 1' => [
                'constructorparams' => [
                    'start_time' => (new \DateTimeImmutable())->setTimestamp(-386380800),
                    'end_time' => (new \DateTimeImmutable())->setTimestamp(115776000),
                    'sort_time' => (new \DateTimeImmutable())->setTimestamp(115776000),
                    'modified_time' => (new \DateTimeImmutable())->setTimestamp(time())
                ]
            ],
            'Dataset 2' => [
                'constructorparams' => [
                    'start_time' => (new \DateTimeImmutable())->setTimestamp(123456),
                    'end_time' => (new \DateTimeImmutable())->setTimestamp(12345678),
                    'sort_time' => (new \DateTimeImmutable())->setTimestamp(1111),
                    'modified_time' => (new \DateTimeImmutable())->setTimestamp(time())
                ]
            ]
        ];
    }
}
