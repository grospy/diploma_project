<?php
//

/**
 * Privacy provider tests.
 *
 * @package    quiz_overview
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_privacy\local\metadata\collection;
use quiz_overview\privacy\provider;
use core_privacy\local\request\writer;
use core_privacy\local\request\transform;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy provider tests class.
 *
 * @package    quiz_overview
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quiz_overview_privacy_provider_testcase extends \core_privacy\tests\provider_testcase {
    /**
     * When no preference exists, there should be no export.
     */
    public function test_preference_unset() {
        global $USER;

        $this->resetAfterTest();
        $this->setAdminUser();

        provider::export_user_preferences($USER->id);

        $this->assertFalse(writer::with_context(\context_system::instance())->has_any_data());
    }

    /**
     * Preference does exist.
     */
    public function test_preference_yes() {
        global $USER;

        $this->resetAfterTest();
        $this->setAdminUser();

        set_user_preference('quiz_overview_slotmarks', 1);

        provider::export_user_preferences($USER->id);

        $writer = writer::with_context(\context_system::instance());
        $this->assertTrue($writer->has_any_data());

        $preferences = $writer->get_user_preferences('quiz_overview');
        $this->assertNotEmpty($preferences->slotmarks);
        $this->assertEquals(transform::yesno(1), $preferences->slotmarks->value);
        $description = get_string('privacy:preference:slotmarks:yes', 'quiz_overview');
        $this->assertEquals($description, $preferences->slotmarks->description);
    }

    /**
     * Preference does exist and is no.
     */
    public function test_preference_no() {
        global $USER;

        $this->resetAfterTest();
        $this->setAdminUser();

        set_user_preference('quiz_overview_slotmarks', 0);

        provider::export_user_preferences($USER->id);

        $writer = writer::with_context(\context_system::instance());
        $this->assertTrue($writer->has_any_data());

        $preferences = $writer->get_user_preferences('quiz_overview');
        $this->assertNotEmpty($preferences->slotmarks);
        $this->assertEquals(transform::yesno(0), $preferences->slotmarks->value);
        $description = get_string('privacy:preference:slotmarks:no', 'quiz_overview');
        $this->assertEquals($description, $preferences->slotmarks->description);
    }
}
