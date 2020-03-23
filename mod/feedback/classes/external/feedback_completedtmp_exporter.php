<?php
//

/**
 * Class for exporting a feedback temporary completion record.
 *
 * @package    mod_feedback
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_feedback\external;
defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for exporting a feedback temporary completion record.
 *
 * @copyright  2017 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class feedback_completedtmp_exporter extends exporter {

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
            'feedback' => array(
                'type' => PARAM_INT,
                'description' => 'The feedback instance id this records belongs to.',
            ),
            'userid' => array(
                'type' => PARAM_INT,
                'description' => 'The user who completed the feedback (0 for anonymous).',
            ),
            'guestid' => array(
                'type' => PARAM_RAW,
                'description' => 'For guests, this is the session key.',
            ),
            'timemodified' => array(
                'type' => PARAM_INT,
                'description' => 'The last time the feedback was completed.',
            ),
            'random_response' => array(
                'type' => PARAM_INT,
                'description' => 'The response number (used when shuffling anonymous responses).',
            ),
            'anonymous_response' => array(
                'type' => PARAM_INT,
                'description' => 'Whether is an anonymous response.',
            ),
            'courseid' => array(
                'type' => PARAM_INT,
                'description' => 'The course id where the feedback was completed.',
            ),
        );
    }
}
