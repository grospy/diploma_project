<?php
//

/**
 * Document icon unit tests.
 *
 * @package    core_search
 * @copyright  2018 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Document icon unit tests.
 *
 * @package    core_search
 * @copyright  2018 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search_document_icon_testcase extends advanced_testcase {
    /**
     * Test that default component gets returned correctly.
     */
    public function test_default_component() {
        $docicon = new \core_search\document_icon('test_name');
        $this->assertEquals('test_name', $docicon->get_name());
        $this->assertEquals('moodle', $docicon->get_component());
    }

    /**
     * Test that name and component get returned correctly.
     */
    public function test_can_get_name_and_component() {
        $docicon = new \core_search\document_icon('test_name', 'test_component');
        $this->assertEquals('test_name', $docicon->get_name());
        $this->assertEquals('test_component', $docicon->get_component());
    }

}
