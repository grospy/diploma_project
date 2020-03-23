<?php
//

/**
 * Discussion data mapper.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\local\data_mappers\legacy;

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\discussion as discussion_entity;
use stdClass;

/**
 * Convert a discussion entity into an stdClass.
 *
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class discussion {
    /**
     * Convert a list of discussion entities into stdClasses.
     *
     * @param discussion_entity[] $authors The authors to convert.
     * @return stdClass[]
     */
    public function to_legacy_objects(array $discussions) : array {
        return array_map(function(discussion_entity $discussion) {
            return (object) [
                'id' => $discussion->get_id(),
                'course' => $discussion->get_course_id(),
                'forum' => $discussion->get_forum_id(),
                'name' => $discussion->get_name(),
                'firstpost' => $discussion->get_first_post_id(),
                'userid' => $discussion->get_user_id(),
                'groupid' => $discussion->get_group_id(),
                'assessed' => $discussion->is_assessed(),
                'timemodified' => $discussion->get_time_modified(),
                'usermodified' => $discussion->get_user_modified(),
                'timestart' => $discussion->get_time_start(),
                'timeend' => $discussion->get_time_end(),
                'pinned' => $discussion->is_pinned(),
                'timelocked' => $discussion->get_locked()
            ];
        }, $discussions);
    }

    /**
     * Convert a discussion entity into an stdClass.
     *
     * @param discussion_entity $discussion The discussion to convert.
     * @return stdClass
     */
    public function to_legacy_object(discussion_entity $discussion) : stdClass {
        return $this->to_legacy_objects([$discussion])[0];
    }
}
