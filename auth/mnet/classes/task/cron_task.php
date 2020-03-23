<?php
//

namespace auth_mnet\task;
defined('MOODLE_INTERNAL') || die();

/**
 * A schedule task for mnet cron.
 *
 * @package   auth_mnet
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
        return get_string('crontask', 'auth_mnet');
    }
    /**
     * Run auth mnet cron.
     */
    public function execute() {
        global $DB, $CFG;

        require_once($CFG->dirroot . '/auth/mnet/auth.php');
        $mnetplugin = new \auth_plugin_mnet();
        $mnetplugin->keepalive_client();

        $random100 = rand(0,100);
        if ($random100 < 10) {
            $longtime = time() - DAYSECS;
            $DB->delete_records_select('mnet_session', "expires < ?", [$longtime]);
        }
    }
}
