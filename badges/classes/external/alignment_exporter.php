<?php
//

/**
 * Contains alignment class for displaying a badge alignment.
 *
 * @package   core_badges
 * @copyright 2018 Dani Palou <dani@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_badges\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for displaying a badge alignment.
 *
 * @package   core_badges
 * @copyright 2018 Dani Palou <dani@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class alignment_exporter extends exporter {

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'id' => [
                'type' => PARAM_INT,
                'description' => 'Alignment id',
                'optional' => true,
            ],
            'badgeid' => [
                'type' => PARAM_INT,
                'description' => 'Badge id',
                'optional' => true,
            ],
            'targetName' => [
                'type' => PARAM_TEXT,
                'description' => 'Target name',
                'optional' => true,
            ],
            'targetUrl' => [
                'type' => PARAM_URL,
                'description' => 'Target URL',
                'optional' => true,
            ],
            'targetDescription' => [
                'type' => PARAM_TEXT,
                'description' => 'Target description',
                'null' => NULL_ALLOWED,
                'optional' => true,
            ],
            'targetFramework' => [
                'type' => PARAM_TEXT,
                'description' => 'Target framework',
                'null' => NULL_ALLOWED,
                'optional' => true,
            ],
            'targetCode' => [
                'type' => PARAM_TEXT,
                'description' => 'Target code',
                'null' => NULL_ALLOWED,
                'optional' => true,
            ]
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
