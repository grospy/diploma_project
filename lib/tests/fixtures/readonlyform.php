<?php
//

/**
 * Fixture for testing the functionality of read-only forms.
 *
 * @package core
 * @copyright 2018 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/formslib.php');

$sections = optional_param('sections', 2, PARAM_INT);
require_login();


/**
 * The form used for testing.
 */
class test_read_only_form extends moodleform {
    protected function definition() {
        $mform = $this->_form;

        $sections = $this->_customdata;

        $mform->addElement('header', 'sectionheader', 'First section');

        $mform->addElement('text', 'name', 'Name');
        $mform->setDefault('name', 'Important information');
        $mform->setType('name', PARAM_RAW);

        $mform->setExpanded('sectionheader', false);

        if ($sections > 1) {
            $mform->addElement('header', 'secondsection', 'Other section header');

            $mform->addElement('text', 'other', 'Other');
            $mform->setDefault('other', 'Other information');
            $mform->setType('other', PARAM_RAW);

            $mform->setExpanded('secondsection', false);
        }

        $this->add_action_buttons();
    }
}

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/lib/tests/fixtures/readonlyform.php');

$form = new test_read_only_form(null, $sections, 'post', '', null, false); // The false here is $editable.

echo $OUTPUT->header();
echo $form->render();
echo $OUTPUT->footer();
