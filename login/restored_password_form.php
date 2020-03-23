<?php

//

/**
 * Magic that deals restored users without passwords.
 *
 * @package    core
 * @subpackage auth
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This is one "supplanter" form that generates
// one correct forgot_password.php request in
// order to get the mailout for 'restored' users
// working automatically without having to
// fill the form manually (the user already has
// filled the username and it has been detected
// as a 'restored' one. Surely, some day this will
// be out, with the forgot_password utility being
// part of each plugin, but now now. See MDL-20846
// for the rationale for this implementation.

defined('MOODLE_INTERNAL') || die();

require_once $CFG->libdir.'/formslib.php';

class login_forgot_password_form extends moodleform {

    function definition() {
        $mform    = $this->_form;

        $username = $this->_customdata['username'];

        $mform->addElement('hidden', 'username', $username);
        $mform->setType('username', PARAM_RAW);

        $this->add_action_buttons(false, get_string('continue'));
    }

}
