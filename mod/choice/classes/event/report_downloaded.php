<?php
//

/**
 * The mod_choice report viewed event.
 *
 * @package mod_choice
 * @copyright 2016 Stephen Bourget
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
 *      - string content: The content we are viewing.
 *      - string format: The report format
 *      - int choiced: The id of the choice
 * }
 *
 * @package    mod_choice
 * @since      Moodle 3.1
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class report_downloaded extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventreportdownloaded', 'mod_choice');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has downloaded the report in the '".$this->other['format']."' format for
            the choice activity with course module id '$this->contextinstanceid'";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/choice/report.php', array('id' => $this->contextinstanceid));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        // Report format downloaded.
        if (!isset($this->other['content'])) {
            throw new \coding_exception('The \'content\' value must be set in other.');
        }
        // Report format downloaded.
        if (!isset($this->other['format'])) {
            throw new \coding_exception('The \'format\' value must be set in other.');
        }
        // ID of the choice activity.
        if (!isset($this->other['choiceid'])) {
            throw new \coding_exception('The \'choiceid\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        return false;
    }

    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['choiceid'] = array('db' => 'choice', 'restore' => 'choice');

        return $othermapped;
    }
}
