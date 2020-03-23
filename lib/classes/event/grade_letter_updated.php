<?php
//

/**
 * Grade letter updated event.
 *
 * @package    core
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Grade letter updated event class.
 *
 * @package    core
 * @since      Moodle 3.5
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grade_letter_updated extends base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['objecttable'] = 'grade_letters';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgradeletterupdated', 'core_grades');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        if ($this->courseid) {
            return "The user with id '$this->userid' updated the letter grade with id '$this->objectid'".
                    " in the course with the id '".$this->courseid."'.";
        } else {
            return "The user with id '$this->userid' updated the letter grade with id '$this->objectid'.";
        }
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        $url = new \moodle_url('/grade/edit/letter/index.php');
        if ($this->courseid) {
            $url->param('id', $this->contextid);
        }
        return $url;
    }

    /**
     * Used for mapping events on restore
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        return array('db' => 'grade_letters', 'restore' => 'grade_letters');
    }

}
