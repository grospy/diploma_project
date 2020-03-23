<?php
//

/**
 * Adhoc task that performs asynchronous backups.
 *
 * @package    core
 * @copyright  2018 Matt Porritt <mattp@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;

use async_helper;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/backup/util/includes/backup_includes.php');
require_once($CFG->dirroot . '/backup/moodle2/backup_plan_builder.class.php');

/**
 * Adhoc task that performs asynchronous backups.
 *
 * @package     core
 * @copyright   2018 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class asynchronous_backup_task extends adhoc_task {

    /**
     * Run the adhoc task and preform the backup.
     */
    public function execute() {
        global $DB;
        $started = time();

        $backupid = $this->get_custom_data()->backupid;
        $backuprecordid = $DB->get_field('backup_controllers', 'id', array('backupid' => $backupid), MUST_EXIST);
        mtrace('Processing asynchronous backup for backup: ' . $backupid);

        // Get the backup controller by backup id.
        $bc = \backup_controller::load_controller($backupid);
        $bc->set_progress(new \core\progress\db_updater($backuprecordid, 'backup_controllers', 'progress'));

        // Do some preflight checks on the backup.
        $status = $bc->get_status();
        $execution = $bc->get_execution();

        // Check that the backup is in the correct status and
        // that is set for asynchronous execution.
        if ($status == \backup::STATUS_AWAITING && $execution == \backup::EXECUTION_DELAYED) {
            // Execute the backup.
            $bc->execute_plan();

            // Send message to user if enabled.
            $messageenabled = (bool)get_config('backup', 'backup_async_message_users');
            if ($messageenabled && $bc->get_status() == \backup::STATUS_FINISHED_OK) {
                $asynchelper = new async_helper('backup', $backupid);
                $asynchelper->send_message();
            }

        } else {
            // If status isn't 700, it means the process has failed.
            // Retrying isn't going to fix it, so marked operation as failed.
            $bc->set_status(\backup::STATUS_FINISHED_ERR);
            mtrace('Bad backup controller status, is: ' . $status . ' should be 700, marking job as failed.');

        }

        // Cleanup.
        $bc->destroy();

        $duration = time() - $started;
        mtrace('Backup completed in: ' . $duration . ' seconds');
    }
}

