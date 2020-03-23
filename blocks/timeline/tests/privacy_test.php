<?php
//

/**
 * Unit tests for the block_timeline implementation of the privacy API.
 *
 * @package    block_timeline
 * @category   test
 * @copyright  2018 Peter Dias <peter@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use \core_privacy\local\request\writer;
use \block_timeline\privacy\provider;

/**
 * Unit tests for the block_timeline implementation of the privacy API.
 *
 * @copyright  2018 Peter Dias <peter@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_timeline_privacy_testcase extends \core_privacy\tests\provider_testcase {

    /**
     * Ensure that export_user_preferences returns no data if the user has not visited the myoverview block.
     */
    public function test_export_user_preferences_no_pref() {
        $this->resetAfterTest();

        $user = $this->getDataGenerator()->create_user();
        provider::export_user_preferences($user->id);
        $writer = writer::with_context(\context_system::instance());
        $this->assertFalse($writer->has_any_data());
    }

    /**
     * Test the export_user_preferences given different inputs
     *
     * @param string $type The name of the user preference to get/set
     * @param string $value The value you are storing
     * @param string $expected The expected value override
     *
     * @dataProvider user_preference_provider
     */
    public function test_export_user_preferences($type, $value, $expected) {
        $this->resetAfterTest();
        $user = $this->getDataGenerator()->create_user();
        set_user_preference($type, $value, $user);
        provider::export_user_preferences($user->id);
        $writer = writer::with_context(\context_system::instance());
        $blockpreferences = $writer->get_user_preferences('block_timeline');
        if (!$expected) {
            $expected = get_string($value, 'block_timeline');
        }
        $this->assertEquals($expected, $blockpreferences->{$type}->value);
    }

    /**
     * Create an array of valid user preferences for the timeline block.
     *
     * @return array Array of valid user preferences.
     */
    public function user_preference_provider() {
        return array(
            array('block_timeline_user_sort_preference', 'sortbydates', ''),
            array('block_timeline_user_sort_preference', 'sortbycourses', ''),
            array('block_timeline_user_sort_preference', 'next7days', ''),
            array('block_timeline_user_sort_preference', 'all', ''),
            array('block_timeline_user_limit_preference', 5, 5),
        );
    }
}
