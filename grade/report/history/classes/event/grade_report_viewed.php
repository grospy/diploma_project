<?php
//

/**
 * Grade history report viewed event.
 *
 * @package    gradereport_history
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_history\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Grade history report viewed event class.
 *
 * @package    gradereport_history
 * @since      Moodle 2.8
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grade_report_viewed extends \core\event\grade_report_viewed {

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgradereportviewed', 'gradereport_history');
    }
}
