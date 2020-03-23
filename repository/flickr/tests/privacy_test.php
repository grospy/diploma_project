<?php
//
/**
 * Privacy tests for repository_flickr.
 *
 * @package    repository_flickr
 * @category   test
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

use \repository_flickr\privacy\provider;
use \core_privacy\local\request\approved_contextlist;
use \core_privacy\local\request\writer;
use \core_privacy\tests\provider_testcase;

/**
 * Unit tests for repository/flickr/privacy/provider
 *
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class repository_flickr_privacy_testcase extends provider_testcase {
    /**
     * Overriding setUp() function to always reset after tests.
     */
    public function setUp() {
        $this->resetAfterTest(true);
    }

    /**
     * Test for provider::export_user_preferences().
     */
    public function test_export_user_preferences() {
        global $DB;

        // Test setup.
        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);
        $contextlist = provider::get_contexts_for_userid($user->id);
        $approvedcontextlist = new approved_contextlist($user, 'repository_flickr', $contextlist->get_contextids());
        $user = $approvedcontextlist->get_user();
        $contextuser = context_user::instance($user->id);

        // Test exporting of Flickr repository user preferences *without* OAuth token/secret preference configured.
        provider::export_user_preferences($user->id);
        $writer = writer::with_context($contextuser);

        // Verify there is no user preferences data exported.
        $this->assertFalse($writer->has_any_data());

        // Test exporting of Flickr repository user preferences *with* OAuth token/secret preference configured.
        set_user_preferences([
            'repository_flickr_access_token' => 'dummy flickr oauth access token',
            'repository_flickr_access_token_secret' => 'dummy flickr oauth access token secret',
        ], $user->id);

        provider::export_user_preferences($user->id);
        $writer = writer::with_context($contextuser);

        // Verify there is user preferences data exported.
        $this->assertTrue($writer->has_any_data());
        $userpreferences = $writer->get_user_preferences('repository_flickr');

        // Verify the OAuth token is not an empty string value and the OAuth secret is an empty string value.
        $accesstoken = $userpreferences->repository_flickr_access_token;
        $this->assertFalse(empty($accesstoken->value));
        $accesstokensecret = $userpreferences->repository_flickr_access_token_secret;
        $this->assertTrue(empty($accesstokensecret->value));
    }
}
