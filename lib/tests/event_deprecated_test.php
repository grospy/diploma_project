<?php
//

/**
 * Tests for deprecated events. Please add tests for deprecated events in this file.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2013 onwards Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class core_event_instances_list_viewed_testcase
 *
 * Tests for deprecated events.
 */
class core_event_deprecated_testcase extends advanced_testcase {

    /**
     * Test event properties and methods.
     */
    public function test_deprecated_course_module_instances_list_viewed_events() {

        // Make sure the abstract class course_module_instances_list_viewed generates a debugging notice.
        require_once(__DIR__.'/fixtures/event_mod_badfixtures.php');
        $this->assertDebuggingCalled(null, DEBUG_DEVELOPER);

    }
}
