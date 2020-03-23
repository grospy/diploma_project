<?php
//

/**
 * Field persistent class
 *
 * @package   core_customfield
 * @copyright 2018 Toni Barbera <toni@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_customfield;

use core\persistent;

defined('MOODLE_INTERNAL') || die;

/**
 * Class field
 *
 * @package core_customfield
 * @copyright 2018 Toni Barbera <toni@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field extends persistent {

    /**
     * Database table.
     */
    const TABLE = 'customfield_field';

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
                'shortname' => [
                        'type' => PARAM_TEXT,
                ],
                'type' => [
                        'type' => PARAM_PLUGIN,
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
                'sortorder' => [
                        'type' => PARAM_INT,
                        'optional' => true,
                        'default' => -1,
                ],
                'categoryid' => [
                        'type' => PARAM_INT
                ],
                'configdata' => [
                        'type' => PARAM_RAW,
                        'optional' => true,
                        'default' => null,
                        'null' => NULL_ALLOWED
                ],
        );
    }

    /**
     * Get decoded configdata.
     *
     * @return array
     */
    protected function get_configdata() : array {
        return json_decode($this->raw_get('configdata'), true) ?? array();
    }
}
