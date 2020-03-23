<?php
//

/**
 * Message viewed event.
 *
 * @package    core
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Message viewed event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int messageid: the id of the message.
 * }
 *
 * @package    core
 * @since      Moodle 2.7
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message_viewed extends base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'message_user_actions';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventmessageviewed', 'message');
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
        return "The user with id '$this->userid' read a message from the user with id '$this->relateduserid'.";
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' must be set.');
        }

        if (!isset($this->other['messageid'])) {
            throw new \coding_exception('The \'messageid\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'message_user_actions', 'restore' => base::NOT_MAPPED);
    }

    public static function get_other_mapping() {
        // Messages are not backed up, so no need to map them on restore.
        $othermapped = array();
        $othermapped['messageid'] = array('db' => 'messages', 'restore' => base::NOT_MAPPED);
        return $othermapped;
    }
}
