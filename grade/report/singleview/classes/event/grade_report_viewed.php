<?php
//

/**
 * Single view report viewed event.
 *
 * @package    gradereport_singleview
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace gradereport_singleview\event;

defined('MOODLE_INTERNAL') || die();

/**
 * User report viewed event class.
 *
 * @package    gradereport_singleview
 * @since      Moodle 2.8
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grade_report_viewed extends \core\event\grade_report_viewed {

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgradereportviewed', 'gradereport_singleview');
    }

    /**
     * Custom validation.
     *
     * Throw \coding_exception notice in case of any problems.
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' value must be set.');
        }
    }
}
