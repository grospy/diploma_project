<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_chat
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Restore date tests.
 *
 * @package    mod_chat
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_chat_restore_date_testcase extends restore_date_testcase {

    public function test_restore_dates() {
        global $DB;

        list($course, $chat) = $this->create_course_and_module('chat');
        $result = mod_chat_external::login_user($chat->id);
        $result = external_api::clean_returnvalue(mod_chat_external::login_user_returns(), $result);
        $chatsid = $result['chatsid'];

        $result = mod_chat_external::send_chat_message($chatsid, 'hello!');
        $result = external_api::clean_returnvalue(mod_chat_external::send_chat_message_returns(), $result);
        $message = $DB->get_record('chat_messages', ['id' => $result['messageid']]);
        $timestamp = 1000;
        $DB->set_field('chat_messages', 'timestamp', $timestamp);

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newchat = $DB->get_record('chat', ['course' => $newcourseid]);

        $this->assertFieldsNotRolledForward($chat, $newchat, ['timemodified']);
        $props = ['chattime'];
        $this->assertFieldsRolledForward($chat, $newchat, $props);

        $newmessages = $DB->get_records('chat_messages', ['chatid' => $newchat->id]);

        foreach ($newmessages as $message) {
            $this->assertEquals($timestamp, $message->timestamp);
        }

    }
}
