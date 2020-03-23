<?php
//

/**
 * Contains related class for displaying information of a tag collection.
 *
 * @package   core_tag
 * @copyright 2019 Juan Leyva <juan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_tag\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Contains related class for displaying information of a tag collection.
 *
 * @package   core_tag
 * @copyright 2019 Juan Leyva <juan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tag_collection_exporter extends exporter {

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'id' => [
                'type' => PARAM_INT,
                'description' => 'Collection id.',
            ],
            'name' => [
                'type' => PARAM_NOTAGS,
                'description' => 'Collection name.',
                'null' => NULL_ALLOWED,
            ],
            'isdefault' => [
                'type' => PARAM_BOOL,
                'description' => 'Whether is the default collection.',
                'default' => false,
            ],
            'component' => [
                'type' => PARAM_COMPONENT,
                'description' => 'Component the collection is related to.',
                'null' => NULL_ALLOWED,
            ],
            'sortorder' => [
                'type' => PARAM_INT,
                'description' => 'Collection ordering in the list.',
            ],
            'searchable' => [
                'type' => PARAM_BOOL,
                'description' => 'Whether the tag collection is searchable.',
                'default' => true,
            ],
            'customurl' => [
                'type' => PARAM_NOTAGS,
                'description' => 'Custom URL for the tag page instead of /tag/index.php.',
                'null' => NULL_ALLOWED,
            ],
        ];
    }
}
