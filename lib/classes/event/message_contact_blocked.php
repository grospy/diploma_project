<?php
//

/**
 * Message contact blocked event.
 *
 * @package    core
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

debugging('core\\event\\message_contact_blocked has been deprecated. Please use
        core\\event\\message_user_blocked instead', DEBUG_DEVELOPER);

/**
 * Message contact blocked event class.
 *
 * @package    core
 * @since      Moodle 2.7
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message_contact_blocked extends base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'message_contacts';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventmessagecontactblocked', 'message');
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/message/index.php', array('user1' => $this->userid, 'user2' => $this->relateduserid));
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' blocked the user with id '$this->relateduserid' on their contact list.";
    }

    /**
     * Return legacy data for add_to_log().
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array(SITEID, 'message', 'block contact', 'index.php?user1=' . $this->relateduserid . '&amp;user2=' .
            $this->userid, $this->relateduserid);
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' must be set.');
        }
    }

    public static function get_objectid_mapping() {
        // Messaging contacts are not backed up, so no need to map them on restore.
        return array('db' => 'message_contacts', 'restore' => base::NOT_MAPPED);
    }

    /**
     * This event has been deprecated.
     *
     * @return boolean
     */
    public static function is_deprecated() {
        return true;
    }
}
