<?php

//

/**
 * Preview the assessment form.
 *
 * @package    mod_workshop
 * @copyright  2009 David Mudrak <david.mudrak@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once(__DIR__.'/locallib.php');

$cmid     = required_param('cmid', PARAM_INT);
$cm       = get_coursemodule_from_id('workshop', $cmid, 0, false, MUST_EXIST);
$course   = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$workshop = $DB->get_record('workshop', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, false, $cm);
if (isguestuser()) {
    print_error('guestsarenotallowed');
}
$workshop = new workshop($workshop, $cm, $course);

require_capability('mod/workshop:editdimensions', $workshop->context);
$PAGE->set_url($workshop->previewform_url());
$PAGE->set_title($workshop->name);
$PAGE->set_heading($course->fullname);
$PAGE->navbar->add(get_string('editingassessmentform', 'workshop'), $workshop->editform_url(), navigation_node::TYPE_CUSTOM);
$PAGE->navbar->add(get_string('previewassessmentform', 'workshop'));
$currenttab = 'editform';

// load the grading strategy logic
$strategy = $workshop->grading_strategy_instance();

// load the assessment form
$mform = $strategy->get_assessment_form($workshop->editform_url(), 'preview');

// output starts here
echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($workshop->name));
echo $OUTPUT->heading(get_string('assessmentform', 'workshop'), 3);
$mform->display();
echo $OUTPUT->footer();
