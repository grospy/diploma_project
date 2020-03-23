<?php
//

/**
 * Unit tests for the data_registry class.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use \tool_dataprivacy\data_registry;

/**
 * Unit tests for the data_registry class.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_dataprivacy_dataregistry_testcase extends advanced_testcase {

    /**
     * Ensure that the get_effective_context_value only errors if provided an inappropriate element.
     *
     * This test is not great because we only test a limited set of values. This is a fault of the underlying API.
     */
    public function test_get_effective_context_value_invalid_element() {
        $this->expectException(coding_exception::class);
        data_registry::get_effective_context_value(\context_system::instance(), 'invalid');
    }

    /**
     * Ensure that the get_effective_contextlevel_value only errors if provided an inappropriate element.
     *
     * This test is not great because we only test a limited set of values. This is a fault of the underlying API.
     */
    public function test_get_effective_contextlevel_value_invalid_element() {
        $this->expectException(coding_exception::class);
        data_registry::get_effective_contextlevel_value(\context_system::instance(), 'invalid');
    }
}
