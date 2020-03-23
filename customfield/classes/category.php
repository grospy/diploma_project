<?php
//

/**
 * Customfield category persistent class
 *
 * @package   core_customfield
 * @copyright 2018 Toni Barbera <toni@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_customfield;

use core\persistent;

defined('MOODLE_INTERNAL') || die;

/**
 * Class category
 *
 * @package core_customfield
 * @copyright 2018 Toni Barbera <toni@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class category extends persistent {
    /**
     * Database table.
     */
    const TABLE = 'customfield_category';

    /**
     * Return the definition of the properties of this model.
     *
     * @return array
     */
    protected static function define_properties() : array {
        return array(
                'name' => [
                        'type' => PARAM_TEXT,
                ],
                'description' => [
                        'type' => PARAM_RAW,
                        'optional' => true,
                        'default' => null,
                        'null' => NULL_ALLOWED
                ],
                'descriptionformat' => [
                        'type' => PARAM_INT,
                        'default' => FORMAT_MOODLE,
                        'optional' => true
                ],
                'component' => [
                        'type' => PARAM_COMPONENT
                ],
                'area' => [
                        'type' => PARAM_COMPONENT
                ],
                'itemid' => [
                        'type' => PARAM_INT,
                        'optional' => true,
                        'default' => 0
                ],
                'contextid' => [
                        'type' => PARAM_INT,
                        'optional' => false
                ],
                'sortorder' => [
                        'type' => PARAM_INT,
                        'optional' => true,
                        'default' => -1
                ],
        );
    }
}
