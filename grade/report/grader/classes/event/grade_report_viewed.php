<?php
//

/**
 * Grader report viewed event.
 *
 * @package    gradereport_grader
 * @copyright  2014 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_grader\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Grader report viewed event class.
 *
 * @package    gradereport_grader
 * @since      Moodle 2.8
 * @copyright  2014 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grade_report_viewed extends \core\event\grade_report_viewed {

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgradereportviewed', 'gradereport_grader');
    }
}
