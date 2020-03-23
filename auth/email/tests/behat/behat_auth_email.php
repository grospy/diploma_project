<?php
//

/**
 * Step definition for auth_email
 *
 * @package    auth_email
 * @category   test
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../../lib/behat/behat_base.php');

/**
 * Step definition for auth_email.
 *
 * @package    auth_email
 * @category   test
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_auth_email extends behat_base {

    /**
     * Emulate clicking on confirmation link from the email
     *
     * @When /^I confirm email for "(?P<username>(?:[^"]|\\")*)"$/
     *
     * @param string $username
     */
    public function i_confirm_email_for($username) {
        global $DB;
        $secret = $DB->get_field('user', 'secret', ['username' => $username], MUST_EXIST);
        $confirmationurl = new moodle_url('/login/confirm.php');
        $confirmationpath = $confirmationurl->out_as_local_url(false);
        $url = $confirmationpath .  '?' . 'data='. $secret .'/'. $username;

        $this->getSession()->visit($this->locate_path($url));
    }
}
