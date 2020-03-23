<?php
//

/**
 * Tests the event observers.
 *
 * @package message_email
 * @category test
 * @copyright 2019 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class for testing the event observers.
 *
 * @package message_email
 * @category test
 * @copyright 2019 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message_email_event_observers_task_testcase extends advanced_testcase {

    /**
     * Test the message viewed event observer.
     */
    public function test_message_viewed_observer() {
        global $DB;

        $this->preventResetByRollback(); // Messaging is not compatible with transactions.

        $this->resetAfterTest();

        // Create the test data.
        $course = $this->getDataGenerator()->create_course();

        $user1 = $this->getDataGenerator()->create_and_enrol($course, 'student');
        $user2 = $this->getDataGenerator()->create_and_enrol($course, 'student');

        $group1 = $this->getDataGenerator()->create_group(array('courseid' => $course->id));

        groups_add_member($group1->id, $user1->id);
        groups_add_member($group1->id, $user2->id);

        $conversation = \core_message\api::create_conversation(
            \core_message\api::MESSAGE_CONVERSATION_TYPE_GROUP,
            [$user1->id, $user2->id],
            'Group 1', \core_message\api::MESSAGE_CONVERSATION_ENABLED,
            'core_group',
            'groups',
            $group1->id,
            context_course::instance($course->id)->id
        );

        $message = new \core\message\message();
        $message->courseid = 1;
        $message->component = 'moodle';
        $message->name = 'instantmessage';
        $message->userfrom = $user1;
        $message->convid = $conversation->id;
        $message->subject = 'message subject';
        $message->fullmessage = 'message body';
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = '<p>message body</p>';
        $message->smallmessage = 'small message';
        $message->notification = '0';

        // Send the message twice.
        $messageid1 = message_send($message);
        $messageid2 = message_send($message);

        // Check there are now 2 messages pending to be sent in the digest.
        $this->assertEquals(2, $DB->count_records('message_email_messages'));

        // Mark one of the messages as read.
        $message1 = $DB->get_record('messages', ['id' => $messageid1]);
        \core_message\api::mark_message_as_read($user2->id, $message1);

        $emailmessage = $DB->get_records('message_email_messages');

        // Check there is now only 1 message pending to be sent in the digest and it is the correct message.
        $this->assertEquals(1, count($emailmessage));

        $emailmessage = reset($emailmessage);

        $this->assertEquals($user2->id, $emailmessage->useridto);
        $this->assertEquals($conversation->id, $emailmessage->conversationid);
        $this->assertEquals($messageid2, $emailmessage->messageid);
    }
}
