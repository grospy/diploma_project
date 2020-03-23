<?php

//

/**
 * Provide interface for topics AJAX course formats
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package course
 */

if (!defined('AJAX_SCRIPT')) {
    define('AJAX_SCRIPT', true);
}
require_once(__DIR__ . '/../config.php');
require_once($CFG->dirroot.'/course/lib.php');

// Initialise ALL the incoming parameters here, up front.
$courseid   = required_param('courseId', PARAM_INT);
$class      = required_param('class', PARAM_ALPHA);
$field      = optional_param('field', '', PARAM_ALPHA);
$sectionid  = optional_param('sectionId', 0, PARAM_INT);
$beforeid   = optional_param('beforeId', 0, PARAM_INT);
$value      = optional_param('value', 0, PARAM_INT);
$id         = optional_param('id', 0, PARAM_INT);

$PAGE->set_url('/course/rest.php', array('courseId'=>$courseid,'class'=>$class));

//NOTE: when making any changes here please make sure it is using the same access control as course/mod.php !!

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
// Check user is logged in and set contexts if we are dealing with resource
if (in_array($class, array('resource'))) {
    $cm = get_coursemodule_from_id(null, $id, $course->id, false, MUST_EXIST);
    require_login($course, false, $cm);
    $modcontext = context_module::instance($cm->id);
} else {
    require_login($course);
}
$coursecontext = context_course::instance($course->id);
require_sesskey();

echo $OUTPUT->header(); // send headers

if ($class === 'section' && $field === 'move') {
    if (!$DB->record_exists('course_sections', array('course' => $course->id, 'section' => $id))) {
        throw new moodle_exception('AJAX commands.php: Bad Section ID ' . $id);
    }

    require_capability('moodle/course:movesections', $coursecontext);
    move_section_to($course, $id, $value);
    // See if format wants to do something about it.
    $response = course_get_format($course)->ajax_section_move();
    if ($response !== null) {
        echo json_encode($response);
    }

} else if ($class === 'resource' && $field === 'move') {

    require_capability('moodle/course:manageactivities', $modcontext);
    if (!$section = $DB->get_record('course_sections', array('course' => $course->id, 'section' => $sectionid))) {
        throw new moodle_exception('AJAX commands.php: Bad section ID '.$sectionid);
    }

    if ($beforeid > 0) {
        $beforemod = get_coursemodule_from_id('', $beforeid, $course->id);
        $beforemod = $DB->get_record('course_modules', array('id' => $beforeid));
    } else {
        $beforemod = null;
    }

    $isvisible = moveto_module($cm, $section, $beforemod);
    echo json_encode(array('visible' => (bool) $isvisible));
}
