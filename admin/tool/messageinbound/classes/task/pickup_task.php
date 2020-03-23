<?php
//

/**
 * A scheduled task to handle Inbound Message e-mail pickup.
 *
 * @package    tool_messageinbound
 * @category   task
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_messageinbound\task;

defined('MOODLE_INTERNAL') || die();

/**
 * A scheduled task to handle Inbound Message e-mail pickup.
 *
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class pickup_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskpickup', 'tool_messageinbound');
    }

    /**
     * Execute the main Inbound Message pickup task.
     */
    public function execute() {
        $manager = new \tool_messageinbound\manager();
        return $manager->pickup_messages();
    }
}
