<?php
//

/**
 * Contains message_notification_list class for displaying on message preferences page.
 *
 * @package   core_message
 * @copyright 2016 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_message\output\preferences;

defined('MOODLE_INTERNAL') || die();

/**
 * Class to create context for the list of notifications on the message preferences page.
 *
 * @package   core_message
 * @copyright 2016 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message_notification_list extends notification_list {

    /**
     * Create the list component output object.
     *
     * @param string $component
     * @param array $readyprocessors
     * @param array $providers
     * @param \stdClass $preferences
     * @param \stdClass $user
     * @return message_notification_list_component
     */
    protected function create_list_component($component, $readyprocessors, $providers, $preferences, $user) {
        return new message_notification_list_component($component, $readyprocessors, $providers, $preferences, $user);
    }
}
