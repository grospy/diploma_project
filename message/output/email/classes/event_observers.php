<?php
//

/**
 * Contains an observer class containing methods for handling events.
 *
 * @package    message_email
 * @copyright  2019 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace message_email;

defined('MOODLE_INTERNAL') || die();

/**
 * Observer class containing methods for handling events.
 *
 * @package    message_email
 * @copyright  2019 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class event_observers {

    /**
     * Message viewed event handler.
     *
     * @param \core\event\message_viewed $event The message viewed event.
     */
    public static function message_viewed(\core\event\message_viewed $event) {
        global $DB;

        $userid = $event->userid;
        $messageid = $event->other['messageid'];

        $DB->delete_records('message_email_messages', ['useridto' => $userid, 'messageid' => $messageid]);
    }
}
