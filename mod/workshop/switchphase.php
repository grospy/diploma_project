<?php

//

/**
 * Change the current phase of the workshop
 *
 * @package    mod_workshop
 * @copyright  2009 David Mudrak <david.mudrak@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once(__DIR__.'/locallib.php');

$cmid       = required_param('cmid', PARAM_INT);            // course module
$phase      = required_param('phase', PARAM_INT);           // the code of the new phase
$confirm    = optional_param('confirm', false, PARAM_BOOL); // confirmation

$cm         = get_coursemodule_from_id('workshop', $cmid, 0, false, MUST_EXIST);
$course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$workshop   = $DB->get_record('workshop', array('id' => $cm->instance), '*', MUST_EXIST);
$workshop   = new workshop($workshop, $cm, $course);

$PAGE->set_url($workshop->switchphase_url($phase), array('cmid' => $cmid, 'phase' => $phase));

require_login($course, false, $cm);
require_capability('mod/workshop:switchphase', $PAGE->context);

if ($confirm) {
    if (!confirm_sesskey()) {
        throw new moodle_exception('confirmsesskeybad');
    }
    if (!$workshop->switch_phase($phase)) {
        print_error('errorswitchingphase', 'workshop', $workshop->view_url());
    }
    redirect($workshop->view_url());
}

$PAGE->set_title($workshop->name);
$PAGE->set_heading($course->fullname);
$PAGE->navbar->add(get_string('switchingphase', 'workshop'));

//
// Output starts here
//
echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($workshop->name));
echo $OUTPUT->confirm(get_string('switchphase' . $phase . 'info', 'workshop'),
                        new moodle_url($PAGE->url, array('confirm' => 1)), $workshop->view_url());
echo $OUTPUT->footer();
