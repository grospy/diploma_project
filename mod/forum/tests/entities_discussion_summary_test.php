<?php
//

/**
 * The discussion_summary entity tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\author as author_entity;
use mod_forum\local\entities\discussion as discussion_entity;
use mod_forum\local\entities\discussion_summary as discussion_summary_entity;
use mod_forum\local\entities\post as post_entity;

/**
 * The discussion_summary entity tests.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_forum_entities_discussion_summary_testcase extends advanced_testcase {
    /**
     * Test the entity returns expected values.
     */
    public function test_entity() {
        $this->resetAfterTest();

        $firstauthor = new author_entity(
            1,
            2,
            'test',
            'person',
            'test person',
            'test@example.com',
            false
        );
        $lastauthor = new author_entity(
            2,
            3,
            'test 2',
            'person 2',
            'test 2 person 2',
            'test2@example.com',
            false
        );
        $discussion = new discussion_entity(
            1,
            1,
            1,
            'test discussion',
            1,
            1,
            0,
            false,
            time(),
            time(),
            0,
            0,
            false,
            0
        );
        $firstpost = new post_entity(
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

        $discussionsummary = new discussion_summary_entity($discussion, $firstpost, $firstauthor, $lastauthor);

        $this->assertEquals($discussion, $discussionsummary->get_discussion());
        $this->assertEquals($firstauthor, $discussionsummary->get_first_post_author());
        $this->assertEquals($lastauthor, $discussionsummary->get_latest_post_author());
        $this->assertEquals($firstpost, $discussionsummary->get_first_post());
    }
}
