<?php
//

/**
 * Class for exporting an object containing a name and a description.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_dataprivacy\external;
defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class that exports an object containing a name and a description.
 *
 * @copyright  2018 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class name_description_exporter extends exporter {

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

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'name' => [
                'type' => PARAM_TEXT,
            ],
            'description' => [
                'type' => PARAM_TEXT,
            ],
        ];
    }
}
