<?php
//

/**
 * Badge criteria updated event.
 *
 * @package    core
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Event triggered after criteria is updated to a badge.
 *
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int badgeid: The ID of the badge affected
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class badge_criteria_updated extends base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['objecttable'] = 'badge_criteria';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventbadgecriteriaupdated', 'badges');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has updated criteria to the badge with id '".$this->other['badgeid']."'.";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/badges/criteria.php', array('id' => $this->other['badgeid']));
    }

    /**
     * Custom validations.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->objectid)) {
            throw new \coding_exception('The \'objectid\' must be set.');
        }
        if (!isset($this->other['badgeid'])) {
            throw new \coding_exception('The \'badgeid\' value must be set in other.');
        }
    }

    /**
     * Used for maping events on restore
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        return array('db' => 'badge_criteria', 'restore' => 'badge_criteria');
    }

    /**
     * Used for maping events on restore
     *
     * @return bool
     */
    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['badgeid'] = array('db' => 'badge', 'restore' => 'badge');
        return $othermapped;
    }
}
