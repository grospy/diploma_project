<?php
//

/**
 * The post_read_receipt_collection entity tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\post_read_receipt_collection as collection_entity;
use mod_forum\local\entities\post as post_entity;

/**
 * The post_read_receipt_collection entity tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_forum_entities_post_read_receipt_collection_testcase extends advanced_testcase {
    /**
     * Test the entity returns expected values.
     */
    public function test_entity() {
        $this->resetAfterTest();

        $user = $this->getDataGenerator()->create_user();
        $missingpost = new post_entity(
            4,
            1,
            0,
            1,
            time(),
            time(),
            true,
            'post subject',
            'post message',
            1,
            true,
            false,
            0,
            false,
            false,
            false,
            null,
            null
        );
        $post = new post_entity(
            1,
            1,
            0,
            1,
            time(),
            time(),
            true,
            'post subject',
            'post message',
            1,
            true,
            false,
            0,
            false,
            false,
            false,
            null,
            null
        );
        $collection = new collection_entity([
            (object) [
                'postid' => 1,
                'userid' => $user->id + 1
            ],
            (object) [
                'postid' => 1,
                'userid' => $user->id
            ],
            (object) [
                'postid' => 4,
                'userid' => $user->id + 1
            ]
        ]);

        $this->assertEquals(true, $collection->has_user_read_post($user, $post));
        $this->assertEquals(false, $collection->has_user_read_post($user, $missingpost));
    }
}
