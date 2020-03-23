<?php
//

/**
 * Types unit tests for the Subsystem Link.
 *
 * @package     core_privacy
 * @category    test
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

use \core_privacy\local\metadata\types\user_preference;

/**
 * Tests for the \core_privacy API's types\user_preference functionality.
 *
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversDefaultClass \core_privacy\local\metadata\types\user_preference
 */
class core_privacy_metadata_types_user_preference extends advanced_testcase {

    /**
     * Ensure that warnings are thrown if string identifiers contain invalid characters.
     *
     * @dataProvider invalid_string_provider
     * @param   string  $name Name
     * @param   string  $summary Summary
     * @covers ::__construct
     */
    public function test_invalid_configs($name, $summary) {
        $record = new user_preference($name, $summary);
        $this->assertDebuggingCalled();
    }

    /**
     * Ensure that warnings are not thrown if debugging is not enabled, even if string identifiers contain invalid characters.
     *
     * @dataProvider invalid_string_provider
     * @param   string  $name Name
     * @param   string  $summary Summary
     * @covers ::__construct
     */
    public function test_invalid_configs_debug_normal($name, $summary) {
        global $CFG;
        $this->resetAfterTest();

        $CFG->debug = DEBUG_NORMAL;
        $record = new user_preference($name, $summary);
        $this->assertDebuggingNotCalled();
    }

    /**
     * Ensure that no warnings are shown for valid combinations.
     *
     * @dataProvider valid_string_provider
     * @param   string  $name Name
     * @param   string  $summary Summary
     * @covers ::__construct
     */
    public function test_valid_configs($name, $summary) {
        $record = new user_preference($name, $summary);
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
                'This table is used for purposes.',
            ],
            'Comma in summary' => [
                'example',
                'privacy,foo',
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
                'privacy:example:valid',
            ],
        ];
    }
}
