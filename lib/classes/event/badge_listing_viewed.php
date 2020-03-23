<?php
//

/**
 * Badge listing viewed event.
 *
 * @package    core
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/badgeslib.php');
/**
 * Event triggered after a badge is viewed.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int badgetype: the type of badge (BADGE_TYPE_SITE or BADGE_TYPE_COURSE).
 *      - int courseid: The ID of the course (Not required for BADGE_TYPE_SITE).
 * }
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class badge_listing_viewed extends base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventbadgelistingviewed', 'badges');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        if ($this->other['badgetype'] == BADGE_TYPE_SITE) {
            $return = "The user with id '$this->userid' has viewed the list of available badges for this site.";
        } else {
            $return = "The user with id '$this->userid' has viewed the list of available badges".
                    " for the course with the id '".$this->other['courseid']."'.";
        }
        return $return;
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        if ($this->other['badgetype'] == BADGE_TYPE_SITE) {
            $params = array('type' => $this->other['badgetype']);
        } else {
            $params = array('id' => $this->other['courseid'], 'type' => $this->other['badgetype']);
        }
        return new \moodle_url('/badges/view.php', $params );
    }

    /**
     * Custom validations.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['badgetype'])) {
            throw new \coding_exception('The \'badgetype\' must be set in other.');
        }
        if ($this->other['badgetype'] == BADGE_TYPE_COURSE) {
            if (!isset($this->other['courseid'])) {
                throw new \coding_exception('The \'courseid\' must be set in other.');
            }
        }
    }

    /**
     * Used for maping events on restore
     *
     * @return bool
     */
    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['courseid'] = array('db' => 'course', 'restore' => 'course');
        return $othermapped;
    }
}
