<?php
//

/**
 * Defines the export questions form.
 *
 * @package    moodlecore
 * @subpackage questionbank
 * @copyright  2007 Jamie Pratt me@jamiep.org
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');


/**
 * Form to export questions from the question bank.
 *
 * @copyright  2007 Jamie Pratt me@jamiep.org
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_export_form extends moodleform {

    protected function definition() {
        global $OUTPUT;

        $mform = $this->_form;

        $defaultcategory = $this->_customdata['defaultcategory'];
        $contexts = $this->_customdata['contexts'];

        // Choice of format, with help.
        $mform->addElement('header', 'fileformat', get_string('fileformat', 'question'));

        $fileformatnames = get_import_export_formats('export');
        $radioarray = array();
        $separators = array();
        foreach ($fileformatnames as $shortname => $fileformatname) {
            $radioarray[] = $mform->createElement('radio', 'format', '', $fileformatname, $shortname);

            $separator = '';
            if (get_string_manager()->string_exists('pluginname_help', 'qformat_' . $shortname)) {
                $separator .= $OUTPUT->help_icon('pluginname', 'qformat_' . $shortname);
            }
            $separator .= '<br>';
            $separators[] = $separator;
        }

        $radioarray[] = $mform->createElement('static', 'makelasthelpiconshowup', '');
        $mform->addGroup($radioarray, "formatchoices", '', $separators, false);
        $mform->addRule("formatchoices", null, 'required', null, 'client');

        // Export options.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('questioncategory', 'category', get_string('exportcategory', 'question'),
                array('contexts' => $contexts, 'top' => true));
        $mform->setDefault('category', $defaultcategory);
        $mform->addHelpButton('category', 'exportcategory', 'question');

        $categorygroup = array();
        $categorygroup[] = $mform->createElement('checkbox', 'cattofile', '', get_string('tofilecategory', 'question'));
        $categorygroup[] = $mform->createElement('checkbox', 'contexttofile', '', get_string('tofilecontext', 'question'));
        $mform->addGroup($categorygroup, 'categorygroup', '', '', false);
        $mform->disabledIf('categorygroup', 'cattofile', 'notchecked');
        $mform->setDefault('cattofile', 1);
        $mform->setDefault('contexttofile', 1);

        // Set a template for the format select elements
        $renderer = $mform->defaultRenderer();
        $template = "{help} {element}\n";
        $renderer->setGroupElementTemplate($template, 'format');

        // Submit buttons.
        $this->add_action_buttons(false, get_string('exportquestions', 'question'));
    }
}
