<?php
//

/**
 * Post read receipt collection class.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\local\entities;

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\post as post_entity;
use stdClass;

/**
 * Post read receipt collection class.
 *
 * Contains the list of read receipts for posts.
 *
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class post_read_receipt_collection {
    /** @var stdClass[] $receiptsbypostid Receipt records indexed by post id */
    private $receiptsbypostid = [];

    /**
     * Constructor.
     *
     * @param array $records The list of post read receipt records.
     */
    public function __construct(array $records) {
        foreach ($records as $record) {
            $postid = $record->postid;

            if (isset($this->receiptsbypostid[$postid])) {
                $this->receiptsbypostid[$postid][] = $record;
            } else {
                $this->receiptsbypostid[$postid] = [$record];
            }
        }
    }

    /**
     * Check whether a user has read a post.
     *
     * @param stdClass $user The user to check
     * @param post_entity $post The post to check
     * @return bool
     */
    public function has_user_read_post(stdClass $user, post_entity $post) : bool {
        global $CFG;
        $isoldpost = ($post->get_time_modified() < (time() - ($CFG->forum_oldpostdays * 24 * 3600)));

        if ($isoldpost) {
            return true;
        }

        $receipts = isset($this->receiptsbypostid[$post->get_id()]) ? $this->receiptsbypostid[$post->get_id()] : [];

        foreach ($receipts as $receipt) {
            if ($receipt->userid == $user->id) {
                return true;
            }
        }

        return false;
    }
}
