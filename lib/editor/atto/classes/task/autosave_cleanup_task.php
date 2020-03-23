<?php
//

/**
 * A scheduled task.
 *
 * @package    editor_atto
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace editor_atto\task;

use \core\task\scheduled_task;

/**
 * Simple task to run the autosave cleanup task.
 */
class autosave_cleanup_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskautosavecleanup', 'editor_atto');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $DB;

        $now = time();
        // This is the oldest time any autosave text will be recovered from.
        // This is so that there is a good chance the draft files will still exist (there are many variables so
        // this is impossible to guarantee).
        $before = $now - 60*60*24*4;

        $DB->delete_records_select('editor_atto_autosave', 'timemodified < :before', array('before' => $before));
    }

}
