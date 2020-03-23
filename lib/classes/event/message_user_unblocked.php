<?php
//

/**
 * Message users unblocked event.
 *
 * @package    core
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Message users unblocked event class.
 *
 * @package    core
 * @since      Moodle 3.6
 * @copyright  2018 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message_user_unblocked extends base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'message_users_blocked';
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventmessageusersunblocked', 'message');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' unblocked the user with id '$this->relateduserid'.";
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
        return array('db' => 'message_users_blocked', 'restore' => base::NOT_MAPPED);
    }
}
