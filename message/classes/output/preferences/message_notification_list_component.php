<?php
//

/**
 * Contains notification_list_component class for displaying on message preferences page.
 *
 * @package   core_message
 * @copyright 2016 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_message\output\preferences;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/message/lib.php');

use renderable;
use templatable;

/**
 * Class to create context for a notification component on the message preferences page.
 *
 * @package   core_message
 * @copyright 2016 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message_notification_list_component extends notification_list_component {

    /**
     * Determine if the preference should be displayed.
     *
     * @param string $preferencekey
     * @return bool
     */
    protected function should_show_preference_key($preferencekey) {
        return $preferencekey === 'message_provider_moodle_instantmessage';
    }
}
