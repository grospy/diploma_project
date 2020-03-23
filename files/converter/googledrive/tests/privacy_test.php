<?php
//

/**
 * Base class for unit tests for fileconverter_googledrive.
 *
 * @package    fileconverter_googledrive
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use \core_privacy\tests\provider_testcase;

/**
 * Unit tests for files/converter/googledrive/classes/privacy/provider.php
 *
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class fileconverter_googledrive_testcase extends provider_testcase {

    /**
     * Test getting the context for the user ID related to this plugin.
     */
    public function test_get_contexts_for_userid() {
        $this->resetAfterTest();

        $user = $this->getDataGenerator()->create_user();
        $contextlist = \fileconverter_googledrive\privacy\provider::get_contexts_for_userid($user->id);
        $this->assertEmpty($contextlist);
    }
}
