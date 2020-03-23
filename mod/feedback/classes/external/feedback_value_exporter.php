<?php
//

/**
 * Class for exporting a feedback response.
 *
 * @package    mod_feedback
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_feedback\external;
defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for exporting a feedback response.
 *
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class feedback_value_exporter extends exporter {

    /**
     * Return the list of properties.
     *
     * @return array list of properties
     */
    protected static function define_properties() {
        return array(
            'id' => array(
                'type' => PARAM_INT,
                'description' => 'The record id.',
            ),
            'course_id' => array(
                'type' => PARAM_INT,
                'description' => 'The course id this record belongs to.',
            ),
            'item' => array(
                'type' => PARAM_INT,
                'description' => 'The item id that was responded.',
            ),
            'completed' => array(
                'type' => PARAM_INT,
                'description' => 'Reference to the feedback_completed table.',
            ),
            'tmp_completed' => array(
                'type' => PARAM_INT,
                'description' => 'Old field - not used anymore.',
            ),
            'value' => array(
                'type' => PARAM_RAW,
                'description' => 'The response value.',
            ),
        );
    }
}
