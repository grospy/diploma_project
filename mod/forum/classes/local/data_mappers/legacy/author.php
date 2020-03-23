<?php
//

/**
 * Author data mapper.
 *
 * @package    mod_forum
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_forum\local\data_mappers\legacy;

defined('MOODLE_INTERNAL') || die();

use mod_forum\local\entities\author as author_entity;
use stdClass;

/**
 * Convert an author entity into an stdClass.
 *
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class author {
    /**
     * Convert a list of author entities into stdClasses.
     *
     * @param author_entity[] $authors The authors to convert.
     * @return stdClass[]
     */
    public function to_legacy_objects(array $authors) : array {
        return array_map(function(author_entity $author) {
            return (object) [
                'id' => $author->get_id(),
                'picture' => $author->get_picture_item_id(),
                'firstname' => $author->get_first_name(),
                'lastname' => $author->get_last_name(),
                'fullname' => $author->get_full_name(),
                'email' => $author->get_email(),
                'deleted' => $author->is_deleted(),
                'middlename' => $author->get_middle_name(),
                'firstnamephonetic' => $author->get_first_name_phonetic(),
                'lastnamephonetic' => $author->get_last_name_phonetic(),
                'alternatename' => $author->get_alternate_name(),
                'imagealt' => $author->get_image_alt()
            ];
        }, $authors);
    }

    /**
     * Convert an author entity into an stdClass.
     *
     * @param author_entity $author The author to convert.
     * @return stdClass
     */
    public function to_legacy_object(author_entity $author) : stdClass {
        return $this->to_legacy_objects([$author])[0];
    }
}
