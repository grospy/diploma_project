<?php
//

/**
 * Provides {@link lib/editor/tests/fixtures/editor_form} class.
 *
 * @package core_editor
 * @copyright 2018 Jake Hau <phuchau1509@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir.'/formslib.php');

/**
 * Class editor_form
 *
 * Demonstrates use of editor with disabledIf function.
 * This fixture is only used by the Behat test.
 *
 * @package core_editor
 * @copyright 2018 Jake Hau <phuchau1509@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class editor_form extends moodleform {

    /**
     * Form definition. Abstract method - always override!
     */
    protected function definition() {
        $mform = $this->_form;
        $editoroptions = $this->_customdata['editoroptions'] ?? null;

        // Add header.
        $mform->addElement('header', 'myheader', 'Editor in Moodle form');

        // Add element control.
        $mform->addElement('select', 'mycontrol', 'My control', ['Enable', 'Disable']);

        // Add editor.
        $mform->addElement('editor', 'myeditor', 'My Editor', null, $editoroptions);
        $mform->setType('myeditor', PARAM_RAW);

        // Add control.
        $mform->disabledIf('myeditor', 'mycontrol', 'eq', 1);
    }
}
