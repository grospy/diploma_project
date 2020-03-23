<?php
//

/**
 * Tests cleaning up the access tokens task.
 *
 * @package mod_lti
 * @category test
 * @copyright 2019 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Tests cleaning up the access tokens task.
 *
 * @package mod_lti
 * @category test
 * @copyright 2019 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_lti_clean_access_tokens_testcase extends advanced_testcase {

    /**
     * Test set up.
     *
     * This is executed before running any test in this file.
     */
    public function setUp() {
        $this->resetAfterTest();
    }

    /**
     * Test the cleanup task.
     */
    public function test_cleanup_task() {
        global $DB;

        $time = time();

        // Create an expired access token.
        $token = new stdClass();
        $token->typeid = 1;
        $token->scope = 'scope';
        $token->token = 'token';
        $token->validuntil = $time - DAYSECS;
        $token->timecreated = $time - DAYSECS;

        $t1id = $DB->insert_record('lti_access_tokens', $token);

        // New token, in the future.
        $token->validuntil = $time + DAYSECS;

        $token->token = 'token2';
        $t2id = $DB->insert_record('lti_access_tokens', $token);

        // Run the task.
        $task = new \mod_lti\task\clean_access_tokens();
        $task->execute();

        // Check there is only one token now.
        $tokens = $DB->get_records('lti_access_tokens');

        $this->assertCount(1, $tokens);

        $token = reset($tokens);

        $this->assertEquals($t2id, $token->id);
    }
}
