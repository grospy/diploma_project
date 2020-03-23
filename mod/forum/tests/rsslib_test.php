<?php
//

/**
 * Tests for the forum implementation of the RSS component.
 *
 * @package    mod_forum
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once(__DIR__ . '/generator_trait.php');
require_once("{$CFG->dirroot}/mod/forum/rsslib.php");

/**
 * Tests for the forum implementation of the RSS component.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_forum_rsslib_testcase extends advanced_testcase {
    // Include the mod_forum test helpers.
    // This includes functions to create forums, users, discussions, and posts.
    use mod_forum_tests_generator_trait;

    /**
     * Ensure that deleted posts are not included.
     */
    public function test_forum_rss_feed_discussions_sql_respect_deleted() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', ['course' => $course->id]);
        $cm = get_coursemodule_from_instance('forum', $forum->id);

        list($user, $otheruser) = $this->helper_create_users($course, 2);

        // Post twice.
        $this->helper_post_to_forum($forum, $otheruser);
        list($discussion, $post) = $this->helper_post_to_forum($forum, $otheruser);

        list($sql, $params) = forum_rss_feed_discussions_sql($forum, $cm);
        $discussions = $DB->get_records_sql($sql, $params);
        $this->assertCount(2, $discussions);

        $post->deleted = 1;
        $DB->update_record('forum_posts', $post);

        list($sql, $params) = forum_rss_feed_discussions_sql($forum, $cm);
        $discussions = $DB->get_records_sql($sql, $params);
        $this->assertCount(1, $discussions);
    }


    /**
     * Ensure that deleted posts are not included.
     */
    public function test_forum_rss_feed_posts_sql_respect_deleted() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', ['course' => $course->id]);
        $cm = get_coursemodule_from_instance('forum', $forum->id);

        list($user, $otheruser) = $this->helper_create_users($course, 2);

        // Post twice.
        $this->helper_post_to_forum($forum, $otheruser);
        list($discussion, $post) = $this->helper_post_to_forum($forum, $otheruser);

        list($sql, $params) = forum_rss_feed_posts_sql($forum, $cm);
        $posts = $DB->get_records_sql($sql, $params);
        $this->assertCount(2, $posts);

        $post->deleted = 1;
        $DB->update_record('forum_posts', $post);

        list($sql, $params) = forum_rss_feed_posts_sql($forum, $cm);
        $posts = $DB->get_records_sql($sql, $params);
        $this->assertCount(1, $posts);
    }
}
