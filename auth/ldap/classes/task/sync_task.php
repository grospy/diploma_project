<?php
//

/**
 * A scheduled task for LDAP user sync.
 *
 * @package    auth_ldap
 * @copyright  2015 Vadim Dvorovenko <Vadimon@mail.ru>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace auth_ldap\task;

/**
 * A scheduled task class for LDAP user sync.
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
        return get_string('synctask', 'auth_ldap');
    }

    /**
     * Run users sync.
     */
    public function execute() {
        global $CFG;
        if (is_enabled_auth('ldap')) {
            $auth = get_auth_plugin('ldap');
            $auth->sync_users(true);
        }
    }

}
