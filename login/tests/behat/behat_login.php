<?php
//

/**
 * Behat login related steps definitions.
 *
 * @package    core
 * @category   test
 * @copyright  2016 Universite de Montreal
 * @author     Gilles-Philippe Leblanc
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL used, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../lib/behat/behat_base.php');

/**
 * Contains functions used by behat to test functionality.
 *
 * @package    core
 * @category   test
 * @copyright  2016 Universite de Montreal
 * @author     Gilles-Philippe Leblanc
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_login extends behat_base {

    /**
     * Force a password change for a specific user.
     *
     * @Given /^I force a password change for user "([^"]*)"$/
     * @param string $username The username of the user whose password will expire
     */
    public function i_force_a_password_change_for_user($username) {
        $user = core_user::get_user_by_username($username, 'id', null, MUST_EXIST);
        set_user_preference("auth_forcepasswordchange", true, $user);
    }
}
