<?php
//

/**
 * Badge revoked event.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int expiredate: Badge expire timestamp.
 *      - int badgeissuedid: Badge issued ID.
 * }
 *
 * @package    core
 * @copyright  2016 Matt Davidson
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Event triggered after a badge is revoked from a user.
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Matt Davidson
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class badge_revoked extends base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['objecttable'] = 'badge';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventbadgerevoked', 'badges');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->relateduserid' has had the badge with id '$this->objectid' revoked.";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/badges/overview.php', array('id' => $this->objectid));
    }

    /**
     * Custom validations.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' must be set.');
        }

        if (!isset($this->objectid)) {
            throw new \coding_exception('The \'objectid\' must be set.');
        }
    }

    /**
     * Get_objectid_mapping method.
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        return array('db' => 'badge', 'restore' => 'badge');
    }

    /**
     * Get_other_mapping method.
     *
     * @return array
     */
    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['badgeissuedid'] = array('db' => 'badge_issued', 'restore' => base::NOT_MAPPED);

        return $othermapped;
    }
}
