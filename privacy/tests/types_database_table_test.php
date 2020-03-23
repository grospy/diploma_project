<?php
//

/**
 * Type unit tests for the Database Table.
 *
 * @package     core_privacy
 * @category    test
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

use \core_privacy\local\metadata\types\database_table;

/**
 * Tests for the \core_privacy API's types\database_table functionality.
 *
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversDefaultClass \core_privacy\local\metadata\types\database_table
 */
class core_privacy_metadata_types_database_table extends advanced_testcase {

    /**
     * Ensure that warnings are thrown if string identifiers contain invalid characters.
     *
     * @dataProvider invalid_string_provider
     * @param   string  $name Name
     * @param   array   $fields List of fields
     * @param   string  $summary Summary
     * @covers ::__construct
     */
    public function test_invalid_configs($name, $fields, $summary) {
        $record = new database_table($name, $fields, $summary);
        $this->assertDebuggingCalled();
    }

    /**
     * Ensure that warnings are not thrown if debugging is not enabled, even if string identifiers contain invalid characters.
     *
     * @dataProvider invalid_string_provider
     * @param   string  $name Name
     * @param   array   $fields List of fields
     * @param   string  $summary Summary
     * @covers ::__construct
     */
    public function test_invalid_configs_debug_normal($name, $fields, $summary) {
        global $CFG;
        $this->resetAfterTest();

        $CFG->debug = DEBUG_NORMAL;
        $record = new database_table($name, $fields, $summary);
        $this->assertDebuggingNotCalled();
    }

    /**
     * Ensure that no warnings are shown for valid combinations.
     *
     * @dataProvider valid_string_provider
     * @param   string  $name Name
     * @param   array   $fields List of fields
     * @param   string  $summary Summary
     * @covers ::__construct
     */
    public function test_valid_configs($name, $fields, $summary) {
        $record = new database_table($name, $fields, $summary);
        $this->assertDebuggingNotCalled();
    }

    /**
     * Data provider with a list of invalid string identifiers.
     *
     * @return  array
     */
    public function invalid_string_provider() {
        return [
            'Space in summary' => [
                'example',
                [
                    'field' => 'privacy:valid',
                ],
                'This table is used for purposes.',
            ],
            'Comma in summary' => [
                'example',
                [
                    'field' => 'privacy:valid',
                ],
                'privacy,foo',
            ],
            'Space in field name' => [
                'example',
                [
                    'field' => 'This field is used for purposes.',
                ],
                'privacy:valid',
            ],
            'Comma in field name' => [
                'example',
                [
                    'field' => 'invalid,name',
                ],
                'privacy:valid',
            ],
            'No fields specified' => [
                'example',
                [],
                'privacy:example:valid',
            ],

        ];
    }

    /**
     * Data provider with a list of valid string identifiers.
     *
     * @return  array
     */
    public function valid_string_provider() {
        return [
            'Valid combination' => [
                'example',
                [
                    'field' => 'privacy:example:valid:field',
                    'field2' => 'privacy:example:valid:field2',
                ],
                'privacy:example:valid',
            ],
        ];
    }
}
