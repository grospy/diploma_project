<?php
//

/**
 * Contains related class for displaying information of a related badge.
 *
 * @package   core_badges
 * @copyright 2018 Dani Palou <dani@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_badges\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for displaying information of a related badge.
 *
 * @package   core_badges
 * @copyright 2018 Dani Palou <dani@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class related_info_exporter extends exporter {

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'id' => [
                'type' => PARAM_INT,
                'description' => 'Badge id',
            ],
            'name' => [
                'type' => PARAM_TEXT,
                'description' => 'Badge name',
            ],
            'version' => [
                'type' => PARAM_TEXT,
                'description' => 'Version',
                'optional' => true,
                'null' => NULL_ALLOWED,
            ],
            'language' => [
                'type' => PARAM_NOTAGS,
                'description' => 'Language',
                'optional' => true,
                'null' => NULL_ALLOWED,
            ],
            'type' => [
                'type' => PARAM_INT,
                'description' => 'Type',
                'optional' => true,
            ],
        ];
    }

    /**
     * Returns a list of objects that are related.
     *
     * @return array
     */
    protected static function define_related() {
        return array(
            'context' => 'context',
        );
    }
}
