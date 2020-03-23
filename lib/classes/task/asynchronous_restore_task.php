<?php
//

/**
 * Adhoc task that performs asynchronous restores.
 *
 * @package    core
 * @copyright  2018 Matt Porritt <mattp@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;

use async_helper;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/backup/util/includes/restore_includes.php');

/**
 * Adhoc task that performs asynchronous restores.
 *
 * @package     core
 * @copyright   2018 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class asynchronous_restore_task extends adhoc_task {

    /**
     * Run the adhoc task and preform the restore.
     */
    public function execute() {
        global $DB;
        $started = time();

        $restoreid = $this->get_custom_data()->backupid;
        $restorerecordid = $DB->get_field('backup_controllers', 'id', array('backupid' => $restoreid), MUST_EXIST);
        mtrace('Processing asynchronous restore for id: ' . $restoreid);

        // Get the restore controller by backup id.
        $rc = \restore_controller::load_controller($restoreid);
        $rc->set_progress(new \core\progress\db_updater($restorerecordid, 'backup_controllers', 'progress'));

        // Do some preflight checks on the restore.
        $status = $rc->get_status();
        $execution = $rc->get_execution();

        // Check that the restore is in the correct status and
        // that is set for asynchronous execution.
        if ($status == \backup::STATUS_AWAITING && $execution == \backup::EXECUTION_DELAYED) {
            // Execute the restore.
            $rc->execute_plan();

            // Send message to user if enabled.
            $messageenabled = (bool)get_config('backup', 'backup_async_message_users');
            if ($messageenabled && $rc->get_status() == \backup::STATUS_FINISHED_OK) {
                $asynchelper = new async_helper('restore', $restoreid);
                $asynchelper->send_message();
            }

        } else {
            // If status isn't 700, it means the process has failed.
            // Retrying isn't going to fix it, so marked operation as failed.
            $rc->set_status(\backup::STATUS_FINISHED_ERR);
            mtrace('Bad backup controller status, is: ' . $status . ' should be 700, marking job as failed.');

        }

        // Cleanup.
        $rc->destroy();

        $duration = time() - $started;
        mtrace('Restore completed in: ' . $duration . ' seconds');
    }
}

