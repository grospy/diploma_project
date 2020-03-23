<?php
//

/**
 * A scheduled task for LDAP roles sync.
 *
 * @package    auth_ldap
 * @author     David Balch <david.balch@conted.ox.ac.uk>
 * @copyright  2017 The Chancellor Masters and Scholars of the University of Oxford {@link http://www.tall.ox.ac.uk}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace auth_ldap\task;

defined('MOODLE_INTERNAL') || die();

/**
 * A scheduled task class for LDAP roles sync.
 *
 * @author     David Balch <david.balch@conted.ox.ac.uk>
 * @copyright  2017 The Chancellor Masters and Scholars of the University of Oxford {@link http://www.tall.ox.ac.uk}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_roles extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('syncroles', 'auth_ldap');
    }

    /**
     * Synchronise role assignments from LDAP.
     */
    public function execute() {
        global $DB;
        if (is_enabled_auth('ldap')) {
            $auth = get_auth_plugin('ldap');
            $users = $DB->get_records('user', array('auth' => 'ldap'));
            foreach ($users as $user) {
                $auth->sync_roles($user);
            }
        }
    }

}
