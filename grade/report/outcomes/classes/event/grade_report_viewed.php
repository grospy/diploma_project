<?php
//

/**
 * Outcomes report viewed event.
 *
 * @package    gradereport_outcomes
 * @copyright  2014 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_outcomes\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Outcomes report viewed event class.
 *
 * @package    gradereport_outcomes
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
        return get_string('eventgradereportviewed', 'gradereport_outcomes');
    }
}
