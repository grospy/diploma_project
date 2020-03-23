<?php
//

namespace repository_dropbox\task;
defined('MOODLE_INTERNAL') || die();

/**
 * A schedule task for dropbox repository cron.
 *
 * @package   repository_dropbox
 * @copyright 2019 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cron_task extends \core\task\scheduled_task {
    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('crontask', 'repository_dropbox');
    }

    /**
     * Run dropbox repository cron.
     */
    public function execute() {
        global $CFG;
        require_once($CFG->dirroot . '/repository/lib.php');

        $instances = \repository::get_instances(['type' => 'dropbox']);
        foreach ($instances as $instance) {
            $instance->cron();
        }
    }
}
