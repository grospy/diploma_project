<?php
//

/**
 * Tests for password changes event.
 *
 * @package    core
 * @category   phpunit
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Tests for event \core\event\user_password_updated
 *
 * @package    core
 * @category   phpunit
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_event_user_password_updated_testcase extends advanced_testcase {
    /**
     * Test the event.
     */
    public function test_event() {
        $this->resetAfterTest();

        $user1 = $this->getDataGenerator()->create_user();
        $context1 = context_user::instance($user1->id);
        $user2 = $this->getDataGenerator()->create_user();
        $context2 = context_user::instance($user2->id);

        $this->setUser($user1);

        // Changing own password.
        $event = \core\event\user_password_updated::create_from_user($user1);
        $this->assertEventContextNotUsed($event);
        $this->assertEquals($user1->id, $event->relateduserid);
        $this->assertSame($context1, $event->get_context());
        $this->assertEventLegacyLogData(null, $event);
        $this->assertFalse($event->other['forgottenreset']);
        $event->trigger();

        // Changing password of other user.
        $event = \core\event\user_password_updated::create_from_user($user2);
        $this->assertEventContextNotUsed($event);
        $this->assertEquals($user2->id, $event->relateduserid);
        $this->assertSame($context2, $event->get_context());
        $this->assertEventLegacyLogData(null, $event);
        $this->assertFalse($event->other['forgottenreset']);
        $event->trigger();

        // Password reset.
        $event = \core\event\user_password_updated::create_from_user($user1, true);
        $this->assertEventContextNotUsed($event);
        $this->assertEquals($user1->id, $event->relateduserid);
        $this->assertSame($context1, $event->get_context());
        $this->assertEventLegacyLogData(array(SITEID, 'user', 'set password', 'profile.php?id='.$user1->id, $user1->id), $event);
        $this->assertTrue($event->other['forgottenreset']);
        $event->trigger();
    }
}
