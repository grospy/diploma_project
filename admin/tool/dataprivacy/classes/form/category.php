<?php
//

/**
 * This file contains the form add/update a data category.
 *
 * @package   tool_dataprivacy
 * @copyright 2018 David Monllao
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_dataprivacy\form;
defined('MOODLE_INTERNAL') || die();

use core\form\persistent;

/**
 * Data category form.
 *
 * @package   tool_dataprivacy
 * @copyright 2018 David Monllao
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class category extends persistent {

    /**
     * @var The persistent class.
     */
    protected static $persistentclass = 'tool_dataprivacy\\category';

    /**
     * Define the form - called by parent constructor
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('text', 'name', get_string('name'), 'maxlength="100"');
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', get_string('required'), 'required', null, 'server');
        $mform->addRule('name', get_string('maximumchars', '', 100), 'maxlength', 100, 'server');

        $mform->addElement('editor', 'description', get_string('description'), null, ['autosave' => false]);
        $mform->setType('description', PARAM_CLEANHTML);

        if (!empty($this->_customdata['showbuttons'])) {
            if (!$this->get_persistent()->get('id')) {
                $savetext = get_string('add');
            } else {
                $savetext = get_string('savechanges');
            }
            $this->add_action_buttons(true, $savetext);
        }
    }
}
