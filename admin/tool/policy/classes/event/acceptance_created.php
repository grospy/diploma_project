<?php
//

/**
 * Provides {@link tool_policy\event\acceptance_created} class.
 *
 * @package     tool_policy
 * @copyright   2018 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_policy\event;

use core\event\base;

defined('MOODLE_INTERNAL') || die();

/**
 * Event acceptance_created
 *
 * @package     tool_policy
 * @copyright   2018 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class acceptance_created extends acceptance_base {

    /**
     * Initialise the event.
     */
    protected function init() {
        parent::init();
        $this->data['crud'] = 'c';
    }

    /**
     * Returns event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('event_acceptance_created', 'tool_policy');
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
            $action = 'created an empty consent record for';
        }
        return "The user with id '{$this->userid}' $action the policy with revision {$this->other['policyversionid']} ".
            "for the user with id '{$this->relateduserid}'";
    }
}