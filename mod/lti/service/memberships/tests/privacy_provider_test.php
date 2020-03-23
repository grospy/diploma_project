<?php
//
/**
 * Unit tests for ltiservice_memberships privacy provider.
 *
 * @package    ltiservice_memberships
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use \core_privacy\tests\provider_testcase;

/**
 * Unit tests for ltiservice_memberships privacy provider.
 *
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ltiservice_memberships_privacy_provider_testcase extends provider_testcase {

    /**
     * Basic setup for these tests.
     */
    public function setUp() {
        $this->resetAfterTest(true);
    }

    /**
     * Test getting the context for the user ID related to this plugin.
     */
    public function test_get_contexts_for_userid() {
        $user = $this->getDataGenerator()->create_user();
        $contextlist = \ltiservice_memberships\privacy\provider::get_contexts_for_userid($user->id);
        $this->assertEmpty($contextlist);
    }
}
