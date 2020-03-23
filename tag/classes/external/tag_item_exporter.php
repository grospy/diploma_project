<?php
//

/**
 * Contains related class for displaying information of a tag item.
 *
 * @package   core_tag
 * @copyright 2019 Juan Leyva <juan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_tag\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Contains related class for displaying information of a tag item.
 *
 * @package   core_tag
 * @copyright 2019 Juan Leyva <juan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tag_item_exporter extends exporter {

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'id' => [
                'type' => PARAM_INT,
                'description' => 'Tag id.',
            ],
            'name' => [
                'type' => PARAM_TAG,
                'description' => 'Tag name.',
            ],
            'rawname' => [
                'type' => PARAM_RAW,
                'description' => 'The raw, unnormalised name for the tag as entered by users.',
            ],
            'isstandard' => [
                'type' => PARAM_BOOL,
                'description' => 'Whether this tag is standard.',
                'default' => false,
            ],
            'tagcollid' => [
                'type' => PARAM_INT,
                'description' => 'Tag collection id.',
            ],
            'taginstanceid' => [
                'type' => PARAM_INT,
                'description' => 'Tag instance id.',
            ],
            'taginstancecontextid' => [
                'type' => PARAM_INT,
                'description' => 'Context the tag instance belongs to.',
            ],
            'itemid' => [
                'type' => PARAM_INT,
                'description' => 'Id of the record tagged.',
            ],
            'ordering' => [
                'type' => PARAM_INT,
                'description' => 'Tag ordering.',
            ],
            'flag' => [
                'type' => PARAM_INT,
                'description' => 'Whether the tag is flagged as inappropriate.',
                'default' => 0,
                'null' => NULL_ALLOWED,
            ],
        ];
    }
}
