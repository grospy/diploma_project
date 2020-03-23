<?php
//

/**
 * Post data mapper.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\local\data_mappers\legacy;

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\post as post_entity;
use stdClass;

/**
 * Convert a post entity into an stdClass.
 *
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class post {
    /**
     * Convert a list of post entities into stdClasses.
     *
     * @param post_entity[] $posts The posts to convert.
     * @return stdClass[]
     */
    public function to_legacy_objects(array $posts) : array {
        return array_map(function(post_entity $post) {
            return (object) [
                'id' => $post->get_id(),
                'discussion' => $post->get_discussion_id(),
                'parent' => $post->get_parent_id(),
                'userid' => $post->get_author_id(),
                'created' => $post->get_time_created(),
                'modified' => $post->get_time_modified(),
                'mailed' => $post->has_been_mailed(),
                'subject' => $post->get_subject(),
                'message' => $post->get_message(),
                'messageformat' => $post->get_message_format(),
                'messagetrust' => $post->is_message_trusted(),
                'attachment' => $post->has_attachments(),
                'totalscore' => $post->get_total_score(),
                'mailnow' => $post->should_mail_now(),
                'deleted' => $post->is_deleted(),
                'privatereplyto' => $post->get_private_reply_recipient_id(),
                'wordcount' => $post->get_wordcount(),
                'charcount' => $post->get_charcount(),
            ];
        }, $posts);
    }

    /**
     * Convert a post entity into an stdClass.
     *
     * @param post_entity $post The post to convert.
     * @return stdClass
     */
    public function to_legacy_object(post_entity $post) : stdClass {
        return $this->to_legacy_objects([$post])[0];
    }
}
