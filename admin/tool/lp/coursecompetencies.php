<?php
//

/**
 * This page lets users to manage site wide competencies.
 *
 * @package    tool_lp
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');

$id = required_param('courseid', PARAM_INT);
$currentmodule = optional_param('mod', 0, PARAM_INT);
if ($currentmodule > 0) {
    $cm = get_coursemodule_from_id('', $currentmodule, 0, false, MUST_EXIST);
}

$params = array('id' => $id);
$course = $DB->get_record('course', $params, '*', MUST_EXIST);

require_login($course);
\core_competency\api::require_enabled();

$context = context_course::instance($course->id);
$urlparams = array('courseid' => $id, 'mod' => $currentmodule);

$url = new moodle_url('/admin/tool/lp/coursecompetencies.php', $urlparams);

list($title, $subtitle) = \tool_lp\page_helper::setup_for_course($url, $course);
if ($currentmodule > 0) {
    $title = get_string('filtermodule', 'report_competency', format_string($cm->name));
}

$output = $PAGE->get_renderer('tool_lp');
$page = new \tool_lp\output\course_competencies_page($course->id, $currentmodule);

echo $output->header();
$baseurl = new moodle_url('/admin/tool/lp/coursecompetencies.php');
$nav = new \tool_lp\output\module_navigation($course->id, $currentmodule, $baseurl);
echo $output->render($nav);
echo $output->heading($title);

echo $output->render($page);

echo $output->footer();
