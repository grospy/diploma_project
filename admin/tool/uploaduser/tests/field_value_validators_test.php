<?php
//

/**
 * Tests for field value validators of tool_uploaduser.
 *
 * @package    tool_uploaduser
 * @copyright  2019 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use tool_uploaduser\local\field_value_validators;

defined('MOODLE_INTERNAL') || die();

global $CFG;

/**
 * Tests for field value validators of tool_uploaduser.
 *
 * @package    tool_uploaduser
 * @copyright  2019 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_value_validators_testcase extends advanced_testcase {

    /**
     * Data provider for \field_value_validators_testcase::test_validate_theme().
     */
    public function themes_provider() {
        return [
            'User themes disabled' => [
                false, 'boost', 'warning', get_string('userthemesnotallowed', 'tool_uploaduser')
            ],
            'User themes enabled, empty theme' => [
                true, '', 'warning', get_string('notheme', 'tool_uploaduser')
            ],
            'User themes enabled, invalid theme' => [
                true, 'badtheme', 'warning', get_string('invalidtheme', 'tool_uploaduser', 'badtheme')
            ],
            'User themes enabled, valid theme' => [
                true, 'boost', 'normal', ''
            ],
        ];
    }

    /**
     * Unit test for \tool_uploaduser\local\field_value_validators::validate_theme()
     *
     * @dataProvider themes_provider
     * @param boolean $userthemesallowed Whether to allow user themes.
     * @param string $themename The theme name to be tested.
     * @param string $expectedstatus The expected status.
     * @param string $expectedmessage The expected validation message.
     */
    public function test_validate_theme($userthemesallowed, $themename, $expectedstatus, $expectedmessage) {
        $this->resetAfterTest();

        // Set value for $CFG->allowuserthemes.
        set_config('allowuserthemes', $userthemesallowed);

        // Validate the theme.
        list($status, $message) = field_value_validators::validate_theme($themename);

        // Check the status and validation message.
        $this->assertEquals($expectedstatus, $status);
        $this->assertEquals($expectedmessage, $message);
    }
}
