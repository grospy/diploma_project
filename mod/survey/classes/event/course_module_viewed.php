<?php
//

/**
 * The mod_survey course module viewed event.
 *
 * @package    mod_survey
 * @copyright  2014 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_survey\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_survery course module viewed event.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - string viewed: what was viewed
 * }
 *
 * @package    mod_survey
 * @since      Moodle 2.7
 * @copyright  2014 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['objecttable'] = 'survey';
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    /**
     * Return the legacy event log data.
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, $this->objecttable, 'view '. $this->other['viewed'], 'view.php?id=' .
            $this->contextinstanceid, $this->objectid, $this->contextinstanceid);
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if (empty($this->other['viewed'])) {
            throw new \coding_exception('Other must contain the key viewed.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'survey', 'restore' => 'survey');
    }

    public static function get_other_mapping() {
        // No need to map 'viewed'.
        return false;
    }
}
