<?php
//

/**
 * Redirects the user to either a lesson or to the lesson statistics
 *
 * @package   mod_lesson
 * @category  grade
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/

/**
 * Require config.php
 */
require_once("../../config.php");
require_once($CFG->dirroot.'/mod/lesson/locallib.php');

$id = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('lesson', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$lesson = new lesson($DB->get_record('lesson', array('id' => $cm->instance), '*', MUST_EXIST));

require_login($course, false, $cm);

$PAGE->set_url('/mod/lesson/grade.php', array('id'=>$cm->id));

if (has_capability('mod/lesson:viewreports', context_module::instance($cm->id))) {
    redirect('report.php?id='.$cm->id);
} else {
    redirect('view.php?id='.$cm->id);
}
