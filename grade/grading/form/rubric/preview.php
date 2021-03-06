<?php
//

/**
 * Preview rubric page
 *
 * @package    gradingform_rubric
 * @copyright  2011 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../../../config.php');
require_once(__DIR__.'/lib.php');
require_once(__DIR__.'/edit_form.php');
require_once($CFG->dirroot.'/grade/grading/lib.php');

$areaid = required_param('areaid', PARAM_INT);

$manager = get_grading_manager($areaid);

list($context, $course, $cm) = get_context_info_array($manager->get_context()->id);

require_login($course, true, $cm);

$controller = $manager->get_controller('rubric');
$options = $controller->get_options();

if (!$controller->is_form_defined() || empty($options['alwaysshowdefinition'])) {
    throw new moodle_exception('nopermissions', 'error', '', get_string('previewrubric', 'gradingform_rubric'));
}

$title = get_string('gradingof', 'gradingform_rubric', $manager->get_area_title());
$PAGE->set_url(new moodle_url('/grade/grading/form/rubric/preview.php', array('areaid' => $areaid)));
$PAGE->set_title($title);
$PAGE->set_heading($title);

echo $OUTPUT->header();
echo $OUTPUT->heading($title);
echo $controller->render_preview($PAGE);
echo $OUTPUT->footer();
