<?php
//

/**
 * Event description tests.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use core_calendar\local\event\value_objects\event_description;

/**
 * Action testcase.
 *
 * @copyright 2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_calendar_event_description_testcase extends advanced_testcase {
    /**
     * Test event description class getters.
     *
     * @dataProvider getters_testcases()
     * @param array $constructorparams Associative array of constructor parameters.
     */
    public function test_getters($constructorparams) {
        $eventdescription = new event_description(
            $constructorparams['value'],
            $constructorparams['format']
        );
        foreach ($constructorparams as $name => $value) {
            $this->assertEquals($eventdescription->{'get_' . $name}(), $value);
        }
    }

    /**
     * Test cases for getters test.
     */
    public function getters_testcases() {
        return [
            'Dataset 1' => [
                'constructorparams' => [
                    'value' => 'Hello',
                    'format' => 1
                ]
            ],
            'Dataset 2' => [
                'constructorparams' => [
                    'value' => 'Goodbye',
                    'format' => 2
                ]
            ]
        ];
    }
}
