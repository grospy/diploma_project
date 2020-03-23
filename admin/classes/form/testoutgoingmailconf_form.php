<?php
//

/**
 * Testing outgoing mail configuration form
 *
 * @package    core
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_admin\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 * Test mail form
 *
 * @package    core
 * @copyright 2019 Victor Deniz <victor@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testoutgoingmailconf_form extends \moodleform {
    /**
     * Add elements to form
     */
    public function definition() {
        $mform = $this->_form;

        // Recipient.
        $options = ['maxlength' => '100', 'size' => '25'];
        $mform->addElement('text', 'recipient', get_string('testoutgoingmailconf_toemail', 'admin'), $options);
        $mform->setType('recipient', PARAM_EMAIL);
        $mform->addRule('recipient', get_string('required'), 'required');

        $buttonarray = array();
        $buttonarray[] = $mform->createElement('submit', 'send', get_string('testoutgoingmailconf_sendtest', 'admin'));
        $buttonarray[] = $mform->createElement('cancel');

        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
        $mform->closeHeaderBefore('buttonar');

    }
}
