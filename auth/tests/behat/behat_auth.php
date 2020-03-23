<?php

//

/**
 * Basic authentication steps definitions.
 *
 * @package    core_auth
 * @category   test
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../lib/behat/behat_base.php');

/**
 * Log in log out steps definitions.
 *
 * @package    core_auth
 * @category   test
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_auth extends behat_base {

    /**
     * Logs in the user. There should exist a user with the same value as username and password.
     *
     * @Given /^I log in as "(?P<username_string>(?:[^"]|\\")*)"$/
     * @param string $username the user to log in as.
     * @param moodle_url|null $wantsurl optional, URL to go to after logging in.
     */
    public function i_log_in_as(string $username, moodle_url $wantsurl = null) {
        // In the mobile app the required tasks are different (does not support $wantsurl).
        if ($this->is_in_app()) {
            $this->execute('behat_app::login', [$username]);
            return;
        }

        $loginurl = new moodle_url('/login/index.php');
        if ($wantsurl !== null) {
            $loginurl->param('wantsurl', $wantsurl->out_as_local_url());
        }

        // Visit login page.
        $this->getSession()->visit($this->locate_path($loginurl->out_as_local_url()));

        // Enter username and password.
        $this->execute('behat_forms::i_set_the_field_to', array('Username', $this->escape($username)));
        $this->execute('behat_forms::i_set_the_field_to', array('Password', $this->escape($username)));

        // Press log in button, no need to check for exceptions as it will checked after this step execution.
        $this->execute('behat_forms::press_button', get_string('login'));
    }

    /**
     * Logs out of the system.
     *
     * @Given /^I log out$/
     */
    public function i_log_out() {

        // Wait for page to be loaded.
        $this->wait_for_pending_js();

        // Click on logout link in footer, as it's much faster.
        $this->execute('behat_general::i_click_on_in_the', array(get_string('logout'), 'link', '#page-footer', "css_element"));
    }
}
