<?php
//

/**
 * shows an analysed view of feedback
 *
 * @copyright Andreas Grabs
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package mod_feedback
 */

require_once("../../config.php");
require_once("lib.php");

$current_tab = 'analysis';

$id = required_param('id', PARAM_INT);  // Course module id.

$url = new moodle_url('/mod/feedback/analysis.php', array('id'=>$id));
$PAGE->set_url($url);

list($course, $cm) = get_course_and_cm_from_cmid($id, 'feedback');
require_course_login($course, true, $cm);

$feedback = $PAGE->activityrecord;
$feedbackstructure = new mod_feedback_structure($feedback, $cm);

$context = context_module::instance($cm->id);

if (!$feedbackstructure->can_view_analysis()) {
    print_error('error');
}

/// Print the page header

$PAGE->set_heading($course->fullname);
$PAGE->set_title($feedback->name);
echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($feedback->name));

/// print the tabs
require('tabs.php');


//get the groupid
$mygroupid = groups_get_activity_group($cm, true);
groups_print_activity_menu($cm, $url);

// Button "Export to excel".
if (has_capability('mod/feedback:viewreports', $context) && $feedbackstructure->get_items()) {
    echo $OUTPUT->container_start('form-buttons');
    $aurl = new moodle_url('/mod/feedback/analysis_to_excel.php', ['sesskey' => sesskey(), 'id' => $id]);
    echo $OUTPUT->single_button($aurl, get_string('export_to_excel', 'feedback'));
    echo $OUTPUT->container_end();
}

// Show the summary.
$summary = new mod_feedback\output\summary($feedbackstructure, $mygroupid);
echo $OUTPUT->render_from_template('mod_feedback/summary', $summary->export_for_template($OUTPUT));

// Get the items of the feedback.
$items = $feedbackstructure->get_items(true);

$check_anonymously = true;
if ($mygroupid > 0 AND $feedback->anonymous == FEEDBACK_ANONYMOUS_YES) {
    $completedcount = $feedbackstructure->count_completed_responses($mygroupid);
    if ($completedcount < FEEDBACK_MIN_ANONYMOUS_COUNT_IN_GROUP) {
        $check_anonymously = false;
    }
}

echo '<div>';
if ($check_anonymously) {
    // Print the items in an analysed form.
    foreach ($items as $item) {
        $itemobj = feedback_get_item_class($item->typ);
        $printnr = ($feedback->autonumbering && $item->itemnr) ? ($item->itemnr . '.') : '';
        $itemobj->print_analysed($item, $printnr, $mygroupid);
    }
} else {
    echo $OUTPUT->heading_with_help(get_string('insufficient_responses_for_this_group', 'feedback'),
                                    'insufficient_responses',
                                    'feedback', '', '', 3);
}
echo '</div>';

echo $OUTPUT->footer();

