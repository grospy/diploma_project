<?php
//

/**
 * Provides the {@link core_form_privacy_provider_testcase} class.
 *
 * @package     core_form
 * @category    test
 * @copyright   2018 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_privacy\local\request\writer;

defined('MOODLE_INTERNAL') || die();

/**
 * Unit tests for the privacy API implementation.
 *
 * @copyright 2018 David Mudrák <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_form_privacy_provider_testcase extends \core_privacy\tests\provider_testcase {

    /**
     * When no preference exists, there should be no export.
     */
    public function test_no_preference() {
        global $USER;
        $this->resetAfterTest();
        $this->setAdminUser();

        \core_form\privacy\provider::export_user_preferences($USER->id);
        $this->assertFalse(writer::with_context(\context_system::instance())->has_any_data());
    }

    /**
     * Test that the recently selected filepicker view mode is exported.
     *
     * @dataProvider data_filemanager_recentviewmode
     * @param string $val Value of the preference filemanager_recentviewmode
     * @param string $desc Text describing the preference
     */
    public function test_filemanager_recentviewmode(string $val, string $desc) {
        global $USER;
        $this->resetAfterTest();
        $this->setAdminUser();

        set_user_preference('filemanager_recentviewmode', $val);

        core_form\privacy\provider::export_user_preferences($USER->id);
        $this->assertTrue(writer::with_context(\context_system::instance())->has_any_data());

        $prefs = writer::with_context(\context_system::instance())->get_user_preferences('core_form');
        $this->assertNotEmpty($prefs->filemanager_recentviewmode);
        $this->assertNotEmpty($prefs->filemanager_recentviewmode->value);
        $this->assertNotEmpty($prefs->filemanager_recentviewmode->description);
        $this->assertEquals($val, $prefs->filemanager_recentviewmode->value);
        $this->assertContains($desc, $prefs->filemanager_recentviewmode->description);
    }

    /**
     * Provides data for the {@link self::test_filemanager_recentviewmode()} method.
     *
     * @return array
     */
    public function data_filemanager_recentviewmode() {
        return [
            'icons' => [
                'val' => '1',
                'desc' => get_string('displayasicons', 'core_repository'),
            ],
            'tree' => [
                'val' => '2',
                'desc' => get_string('displayastree', 'core_repository'),
            ],
            'details' => [
                'val' => '3',
                'desc' => get_string('displaydetails', 'core_repository'),
            ],
            'unknown' => [
                'val' => 'unexpectedvalue_foo_bar',
                'desc' => 'unexpectedvalue_foo_bar',
            ],
        ];
    }
}
