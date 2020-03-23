<?php
//

/**
 * Provides {@link tool_policy\event\acceptance_updated} class.
 *
 * @package     tool_policy
 * @copyright   2018 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_policy\event;

use core\event\base;

defined('MOODLE_INTERNAL') || die();

/**
 * Event acceptance_updated
 *
 * @package     tool_policy
 * @copyright   2018 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class acceptance_updated extends acceptance_base {

    /**
     * Initialise the event.
     */
    protected function init() {
        parent::init();
        $this->data['crud'] = 'u';
    }

    /**
     * Returns event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('event_acceptance_updated', 'tool_policy');
    }

    /**
     * Get the event description.
     *
     * @return string
     */
    public function get_description() {
        if ($this->other['status'] == 1) {
            $action = 'added consent to';
        } else if ($this->other['status'] == -1) {
            $action = 'revoked consent to';
        } else {
            $action = 'updated consent to';
        }
        return "The user with id '{$this->userid}' $action the policy with revision {$this->other['policyversionid']} ".
            "for the user with id '{$this->relateduserid}'";
    }
}