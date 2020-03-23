<?php
//

/**
 * A scheduled task for CAS user sync.
 *
 * @package    auth_cas
 * @copyright  2015 Vadim Dvorovenko <Vadimon@mail.ru>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace auth_cas\task;

/**
 * A scheduled task class for CAS user sync.
 *
 * @copyright  2015 Vadim Dvorovenko <Vadimon@mail.ru>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('synctask', 'auth_cas');
    }

    /**
     * Run users sync.
     */
    public function execute() {
        global $CFG;
        if (is_enabled_auth('cas')) {
            $auth = get_auth_plugin('cas');
            $auth->sync_users(true);
        }
    }

}
