<?php
//

/**
 * The post entity tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\post as post_entity;

/**
 * The post entity tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_forum_entities_post_testcase extends advanced_testcase {
    /**
     * Test the entity returns expected values.
     */
    public function test_entity() {
        $this->resetAfterTest();

        $owner = $this->getDataGenerator()->create_user();
        $notowner = $this->getDataGenerator()->create_user();
        $past = time() - 10;
        $post = new post_entity(
            4,
            1,
            0,
            $owner->id,
            $past,
            $past,
            true,
            'post subject',
            'post message',
            FORMAT_MOODLE,
            true,
            false,
            0,
            false,
            false,
            false,
            null,
            null
        );

        $this->assertEquals(4, $post->get_id());
        $this->assertEquals(1, $post->get_discussion_id());
        $this->assertEquals(0, $post->get_parent_id());
        $this->assertEquals(false, $post->has_parent());
        $this->assertEquals($owner->id, $post->get_author_id());
        $this->assertEquals($past, $post->get_time_created());
        $this->assertEquals($past, $post->get_time_modified());
        $this->assertEquals(true, $post->has_been_mailed());
        $this->assertEquals('post subject', $post->get_subject());
        $this->assertEquals('post message', $post->get_message());
        $this->assertEquals(FORMAT_MOODLE, $post->get_message_format());
        $this->assertEquals(true, $post->is_message_trusted());
        $this->assertEquals(false, $post->has_attachments());
        $this->assertEquals(0, $post->get_total_score());
        $this->assertEquals(false, $post->should_mail_now());
        $this->assertEquals(false, $post->is_deleted());
        $this->assertTrue($post->get_age() >= 10);
        $this->assertEquals(true, $post->is_owned_by_user($owner));
        $this->assertEquals(false, $post->is_owned_by_user($notowner));
    }
}
