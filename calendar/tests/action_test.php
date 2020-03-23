<?php
//

/**
 * Action tests.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use core_calendar\local\event\value_objects\action;

/**
 * Action testcase.
 *
 * @copyright 2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_calendar_action_testcase extends advanced_testcase {
    /**
     * Test action class getters.
     *
     * @dataProvider getters_testcases()
     * @param array $constructorparams Associative array of constructor parameters.
     */
    public function test_getters($constructorparams) {
        $action = new action(
            $constructorparams['name'],
            $constructorparams['url'],
            $constructorparams['item_count'],
            $constructorparams['actionable']
        );

        foreach ($constructorparams as $name => $value) {
            if ($name == 'actionable') {
                $this->assertEquals($action->is_actionable(), $value);
            } else {
                $this->assertEquals($action->{'get_' . $name}(), $value);
            }
        }
    }

    /**
     * Test cases for getters test.
     */
    public function getters_testcases() {
        return [
            'Dataset 1' => [
                'constructorparams' => [
                    'name' => 'Hello',
                    'url' => new moodle_url('http://example.com'),
                    'item_count' => 1,
                    'actionable' => true
                ]
            ],
            'Dataset 2' => [
                'constructorparams' => [
                    'name' => 'Goodbye',
                    'url' => new moodle_url('http://example.com'),
                    'item_count' => 2,
                    'actionable' => false
                ]
            ]
        ];
    }
}
