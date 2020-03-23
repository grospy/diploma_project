<?php
//

/**
 * A scheduled task to handle cleanup of old, unconfirmed e-mails.
 *
 * @package    tool_messageinbound
 * @category   task
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_messageinbound\task;

defined('MOODLE_INTERNAL') || die();

/**
 * A scheduled task to handle cleanup of old, unconfirmed e-mails.
 *
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cleanup_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskcleanup', 'tool_messageinbound');
    }

    /**
     * Execute the main Inbound Message pickup task.
     */
    public function execute() {
        $manager = new \tool_messageinbound\manager();
        $manager->tidy_old_messages();
        $manager->tidy_old_verification_failures();
    }
}
