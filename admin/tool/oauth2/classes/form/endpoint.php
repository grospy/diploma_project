<?php
//

/**
 * This file contains the form add/update oauth2 endpoint.
 *
 * @package   tool_oauth2
 * @copyright 2017 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_oauth2\form;
defined('MOODLE_INTERNAL') || die();

use stdClass;
use core\form\persistent;

/**
 * Issuer form.
 *
 * @package   tool_oauth2
 * @copyright 2017 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class endpoint extends persistent {

    /** @var string $persistentclass */
    protected static $persistentclass = 'core\\oauth2\\endpoint';

    /** @var array $fieldstoremove */
    protected static $fieldstoremove = array('submitbutton', 'action');

    /**
     * Define the form - called by parent constructor
     */
    public function definition() {
        global $PAGE;

        $mform = $this->_form;
        $endpoint = $this->get_persistent();

        // Name.
        $mform->addElement('text', 'name', get_string('endpointname', 'tool_oauth2'));
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'endpointname', 'tool_oauth2');

        // Url.
        $mform->addElement('text', 'url', get_string('endpointurl', 'tool_oauth2'));
        $mform->addRule('url', null, 'required', null, 'client');
        $mform->addRule('url', get_string('maximumchars', '', 1024), 'maxlength', 1024, 'client');
        $mform->addHelpButton('url', 'endpointurl', 'tool_oauth2');

        $mform->addElement('hidden', 'action', 'edit');
        $mform->setType('action', PARAM_ALPHA);

        $mform->addElement('hidden', 'issuerid', $endpoint->get('issuerid'));
        $mform->setType('issuerid', PARAM_INT);
        $mform->setConstant('issuerid', $this->_customdata['issuerid']);

        $mform->addElement('hidden', 'id', $endpoint->get('id'));
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons(true, get_string('savechanges', 'tool_oauth2'));
    }

}

