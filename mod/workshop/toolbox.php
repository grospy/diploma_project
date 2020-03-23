<?php

//

/**
 * Various workshop maintainance utilities
 *
 * @package    mod_workshop
 * @copyright  2010 David Mudrak <david.mudrak@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once(__DIR__.'/locallib.php');

$id         = required_param('id', PARAM_INT); // course_module ID
$tool       = required_param('tool', PARAM_ALPHA);

$cm         = get_coursemodule_from_id('workshop', $id, 0, false, MUST_EXIST);
$course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$workshop   = $DB->get_record('workshop', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, false, $cm);
$workshop = new workshop($workshop, $cm, $course);
require_sesskey();

$params = array(
    'context' => $workshop->context,
    'courseid' => $course->id,
    'other' => array('workshopid' => $workshop->id)
);

switch ($tool) {
case 'clearaggregatedgrades':
    require_capability('mod/workshop:overridegrades', $workshop->context);
    $workshop->clear_submission_grades();
    $workshop->clear_grading_grades();
    $event = \mod_workshop\event\assessment_evaluations_reset::create($params);
    $event->trigger();
    break;

case 'clearassessments':
    require_capability('mod/workshop:overridegrades', $workshop->context);
    $workshop->clear_assessments();
    $event = \mod_workshop\event\assessments_reset::create($params);
    $event->trigger();
    break;
}

redirect($workshop->view_url());
