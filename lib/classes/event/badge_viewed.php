<?php
//

/**
 * Badge viewed event.
 *
 * @package    core
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Event triggered after a badge is viewed.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int badgeid: the ID of the badge.
 *      - int badgehash: The UID of the awarded badge.
 * }
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class badge_viewed extends base {

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
        return get_string('eventbadgeviewed', 'badges');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has viewed the badge with the id '".$this->other['badgeid']."'.";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/badges/badge.php', array('hash' => $this->other['badgehash']));
    }

    /**
     * Custom validations.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['badgeid'])) {
            throw new \coding_exception('The \'badgeid\' must be set in other.');
        }
        if (!isset($this->other['badgehash'])) {
            throw new \coding_exception('The \'badgehash\' must be set in other.');
        }
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
