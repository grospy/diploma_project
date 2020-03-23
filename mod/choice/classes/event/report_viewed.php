<?php
//

/**
 * The mod_choice report viewed event.
 *
 * @package mod_choice
 * @copyright 2013 Adrian Greeve <adrian@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_choice\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_choice report viewed event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - string content: (optional) The content we are viewing.
 * }
 *
 * @package    mod_choice
 * @since      Moodle 2.6
 * @copyright  2013 Adrian Greeve
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class report_viewed extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = 'choice';
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventreportviewed', 'mod_choice');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has viewed the report for the choice activity with course module id
            '$this->contextinstanceid'";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/choice/report.php', array('id' => $this->contextinstanceid));
    }

    /**
     * replace add_to_log() statement.
     *
     * @return array of parameters to be passed to legacy add_to_log() function.
     */
    protected function get_legacy_logdata() {
        $url = new \moodle_url('report.php', array('id' => $this->contextinstanceid));
        return array($this->courseid, 'choice', 'report', $url->out(), $this->objectid, $this->contextinstanceid);
    }

    public static function get_objectid_mapping() {
        return array('db' => 'choice', 'restore' => 'choice');
    }

    public static function get_other_mapping() {
        // No need to map the 'content' value.
        return false;
    }
}
