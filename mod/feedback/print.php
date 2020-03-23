<?php
//

/**
 * print a printview of feedback-items
 *
 * @author Andreas Grabs
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package mod_feedback
 */

require_once("../../config.php");
require_once("lib.php");

$id = required_param('id', PARAM_INT);
$courseid = optional_param('courseid', false, PARAM_INT); // Course where this feedback is mapped to - used for return link.

$PAGE->set_url('/mod/feedback/print.php', array('id'=>$id));

list($course, $cm) = get_course_and_cm_from_cmid($id, 'feedback');
require_course_login($course, true, $cm);

$feedback = $PAGE->activityrecord;
$feedbackstructure = new mod_feedback_structure($feedback, $cm, $courseid);

$PAGE->set_pagelayout('popup');

// Print the page header.
$strfeedbacks = get_string("modulenameplural", "feedback");
$strfeedback  = get_string("modulename", "feedback");

$feedback_url = new moodle_url('/mod/feedback/index.php', array('id'=>$course->id));
$PAGE->navbar->add($strfeedbacks, $feedback_url);
$PAGE->navbar->add(format_string($feedback->name));

$PAGE->set_title($feedback->name);
$PAGE->set_heading($course->fullname);
echo $OUTPUT->header();

// Print the main part of the page.
echo $OUTPUT->heading(format_string($feedback->name));

$continueurl = new moodle_url('/mod/feedback/view.php', array('id' => $id));
if ($courseid) {
    $continueurl->param('courseid', $courseid);
}

$form = new mod_feedback_complete_form(mod_feedback_complete_form::MODE_PRINT,
        $feedbackstructure, 'feedback_print_form');
echo $OUTPUT->continue_button($continueurl);
$form->display();
echo $OUTPUT->continue_button($continueurl);

// Finish the page.
echo $OUTPUT->footer();

