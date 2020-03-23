<?php
//

/**
 * Tests for the manager observer.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once('data_privacy_testcase.php');

/**
 * API tests.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_dataprivacy_manager_observer_testcase extends data_privacy_testcase {
    /**
     * Ensure that when users are configured as DPO, they are sent an message upon failure.
     */
    public function test_handle_component_failure() {
        $this->resetAfterTest();

        // Create another user who is not a DPO.
        $this->getDataGenerator()->create_user();

        // Create two DPOs.
        $dpo1 = $this->getDataGenerator()->create_user();
        $dpo2 = $this->getDataGenerator()->create_user();
        $this->assign_site_dpo(array($dpo1, $dpo2));
        $dpos = \tool_dataprivacy\api::get_site_dpos();

        $observer = new \tool_dataprivacy\manager_observer();

        // Handle the failure, catching messages.
        $mailsink = $this->redirectMessages();
        $mailsink->clear();
        $observer->handle_component_failure(new \Exception('error'), 'foo', 'bar', 'baz', ['foobarbaz', 'bum']);

        // Messages should be sent to both DPOs only.
        $this->assertEquals(2, $mailsink->count());

        $messages = $mailsink->get_messages();
        $messageusers = array_map(function($message) {
            return $message->useridto;
        }, $messages);

        $this->assertEquals(array_keys($dpos), $messageusers, '', 0.0, 0, true);
    }

    /**
     * Ensure that when no user is configured as DPO, the message is sent to admin instead.
     */
    public function test_handle_component_failure_no_dpo() {
        $this->resetAfterTest();

        // Create another user who is not a DPO or admin.
        $this->getDataGenerator()->create_user();

        $observer = new \tool_dataprivacy\manager_observer();

        $mailsink = $this->redirectMessages();
        $mailsink->clear();
        $observer->handle_component_failure(new \Exception('error'), 'foo', 'bar', 'baz', ['foobarbaz', 'bum']);

        // Messages should have been sent only to the admin.
        $this->assertEquals(1, $mailsink->count());

        $messages = $mailsink->get_messages();
        $message = reset($messages);

        $admin = \core_user::get_user_by_username('admin');
        $this->assertEquals($admin->id, $message->useridto);
    }
}
