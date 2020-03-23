<?php
//

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/webservice/tests/helpers.php');

use tool_templatelibrary\external;

/**
 * External learning plans webservice API tests.
 *
 * @package tool_templatelibrary
 * @copyright 2015 Damyon Wiese
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_templatelibrary_external_testcase extends externallib_advanced_testcase {

    /**
     * Test list all.
     */
    public function test_list_templates() {
        $result = external::list_templates('', '');
        $count = count($result);
        // We have 3 templates in this tool - and there must be more else where.
        $this->assertGreaterThan(3, $count);
    }

    /**
     * Test we can filter by component.
     */
    public function test_list_templates_for_component() {
        $result = external::list_templates('tool_templatelibrary', '');
        $count = count($result);
        $this->assertEquals(3, $count);

        $this->assertContains("tool_templatelibrary/display_template", $result);
        $this->assertContains("tool_templatelibrary/search_results", $result);
        $this->assertContains("tool_templatelibrary/list_templates_page", $result);
    }

    /**
     * Test we can filter by a string.
     */
    public function test_list_templates_with_filter() {
        $result = external::list_templates('tool_templatelibrary', 'page');
        $count = count($result);
        // Should be only one matching template.
        $this->assertEquals(1, $count);
        $this->assertEquals($result[0], "tool_templatelibrary/list_templates_page");
    }

    public function test_load_canonical_template() {
        global $CFG;

        $originaltheme = $CFG->theme;
        // Change the theme to 'base' because it overrides these templates.
        $CFG->theme = 'boost';

        $template = external::load_canonical_template('core', 'notification_error');

        // Only the base template should contain the docs.
        $this->assertContains('@template core/notification_error', $template);

        // Restore the original theme.
        $CFG->theme = $originaltheme;
    }
}
