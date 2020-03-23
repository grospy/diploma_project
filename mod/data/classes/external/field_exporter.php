<?php
//

/**
 * Class for exporting field data.
 *
 * @package    mod_data
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_data\external;
defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for exporting field data.
 *
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_exporter extends exporter {

    protected static function define_properties() {

        $properties = array(
            'id' => array(
                'type' => PARAM_INT,
                'description' => 'Field id.',
            ),
            'dataid' => array(
                'type' => PARAM_INT,
                'description' => 'The field type of the content.',
                'default' => 0,
            ),
            'type' => array(
                'type' => PARAM_PLUGIN,
                'description' => 'The field type.',
            ),
            'name' => array(
                'type' => PARAM_TEXT,
                'description' => 'The field name.',
            ),
            'description' => array(
                'type' => PARAM_RAW,
                'description' => 'The field description.',
            ),
            'required' => array(
                'type' => PARAM_BOOL,
                'description' => 'Whether is a field required or not.',
                'default' => 0,
            ),
        );
        // Field possible parameters.
        for ($i = 1; $i <= 10; $i++) {
            $properties["param$i"] = array(
                'type' => PARAM_RAW,
                'description' => 'Field parameters',
                'null' => NULL_ALLOWED,
            );
        }

        return $properties;
    }

    protected static function define_related() {
        // Context is required for text formatting.
        return array(
            'context' => 'context',
        );
    }
}
