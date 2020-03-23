<?php
//

/**
 * A scheduled task.
 *
 * @package    core
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\oauth2;

use \core\task\scheduled_task;
use core_user;
use moodle_exception;

defined('MOODLE_INTERNAL') || die();

/**
 * Task to refresh system tokens regularly. Admins are notified in case an authorisation expires.
 * @package    core
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class refresh_system_tokens_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskrefreshsystemtokens', 'admin');
    }

    /**
     * Notify admins when an OAuth refresh token expires. Should not happen if cron is running regularly.
     * @param \core\oauth2\issuer $issuer
     */
    protected function notify_admins(\core\oauth2\issuer $issuer) {
        global $CFG;
        $admins = get_admins();

        if (empty($admins)) {
            return;
        }
        foreach ($admins as $admin) {
            $strparams = ['siteurl' => $CFG->wwwroot, 'issuer' => $issuer->get('name')];
            $long = get_string('oauthrefreshtokenexpired', 'core_admin', $strparams);
            $short = get_string('oauthrefreshtokenexpiredshort', 'core_admin', $strparams);
            $message = new \core\message\message();
            $message->courseid          = SITEID;
            $message->component         = 'moodle';
            $message->name              = 'errors';
            $message->userfrom          = core_user::get_noreply_user();
            $message->userto            = $admin;
            $message->subject           = $short;
            $message->fullmessage       = $long;
            $message->fullmessageformat = FORMAT_PLAIN;
            $message->fullmessagehtml   = $long;
            $message->smallmessage      = $short;
            $message->notification      = 1;
            message_send($message);
        }
    }


    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        $issuers = \core\oauth2\api::get_all_issuers();
        foreach ($issuers as $issuer) {
            if ($issuer->is_system_account_connected()) {
                try {
                    // Try to get an authenticated client; renew token if necessary.
                    // Returns false or throws a moodle_exception on error.
                    $success = \core\oauth2\api::get_system_oauth_client($issuer);
                } catch (moodle_exception $e) {
                    $success = false;
                }
                if ($success === false) {
                    $this->notify_admins($issuer);
                }
            }
        }
    }

}
