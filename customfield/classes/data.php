<?php
//

/**
 * Data persistent class
 *
 * @package   core_customfield
 * @copyright 2018 Toni Barbera <toni@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_customfield;

use core\persistent;

defined('MOODLE_INTERNAL') || die;

/**
 * Class data
 *
 * @package core_customfield
 * @copyright 2018 Toni Barbera <toni@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class data extends persistent {

    /**
     * Database data.
     */
    const TABLE = 'customfield_data';

    /**
     * Return the definition of the properties of this model.
     *
     * @return array
     */
    protected static function define_properties() : array {
        return array(
                'fieldid'        => [
                        'type' => PARAM_INT,
                        'optional' => false,
                        'null'     => NULL_NOT_ALLOWED
                ],
                'instanceid'       => [
                        'type' => PARAM_INT,
                        'optional' => false,
                        'null'     => NULL_NOT_ALLOWED
                ],
                'intvalue'       => [
                        'type'     => PARAM_INT,
                        'optional' => true,
                        'default'  => null,
                        'null'     => NULL_ALLOWED
                ],
                'decvalue'       => [
                        'type'     => PARAM_FLOAT,
                        'optional' => true,
                        'default'  => null,
                        'null'     => NULL_ALLOWED
                ],
                'charvalue'      => [
                        'type'     => PARAM_TEXT,
                        'optional' => true,
                        'default'  => null,
                        'null'     => NULL_ALLOWED
                ],
                'shortcharvalue' => [
                        'type'     => PARAM_TEXT,
                        'optional' => true,
                        'default'  => null,
                        'null'     => NULL_ALLOWED
                ],
                // Mandatory field.
                'value'          => [
                        'type'    => PARAM_RAW,
                        'null'    => NULL_NOT_ALLOWED,
                        'default' => ''
                ],
                // Mandatory field.
                'valueformat'    => [
                        'type'    => PARAM_INT,
                        'null'    => NULL_NOT_ALLOWED,
                        'default' => FORMAT_MOODLE,
                        'optional' => true
                ],
                'contextid'      => [
                        'type'     => PARAM_INT,
                        'optional' => false,
                        'null'     => NULL_NOT_ALLOWED
                ]
        );
    }

}
