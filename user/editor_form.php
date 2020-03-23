<?php
//

/**
 * Form to edit a users editor preferences.
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    //  It must be included from a Moodle page.
}

require_once($CFG->dirroot.'/lib/formslib.php');

/**
 * Class user_edit_editor_form.
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_edit_editor_form extends moodleform {

    /**
     * Define the form.
     */
    public function definition () {
        global $CFG, $COURSE;

        $mform = $this->_form;

        $editors = editors_get_enabled();

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        if (count($editors) > 1) {
            $choices = array('' => get_string('defaulteditor'));
            $firsteditor = '';
            foreach (array_keys($editors) as $editor) {
                if (!$firsteditor) {
                    $firsteditor = $editor;
                }
                $choices[$editor] = get_string('pluginname', 'editor_' . $editor);
            }
            $mform->addElement('select', 'preference_htmleditor', get_string('textediting'), $choices);
            $mform->addHelpButton('preference_htmleditor', 'textediting');
            $mform->setDefault('preference_htmleditor', '');
        } else {
            // Empty string means use the first chosen text editor.
            $mform->addElement('hidden', 'preference_htmleditor');
            $mform->setDefault('preference_htmleditor', '');
            $mform->setType('preference_htmleditor', PARAM_PLUGIN);
        }

        $this->add_action_buttons(true, get_string('savechanges'));
    }
}


