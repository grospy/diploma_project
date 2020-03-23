<?php
//

/**
 * Manage course custom fields
 *
 * @package core_course
 * @copyright 2018 Toni Barbera (toni@moodle.com)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');

admin_externalpage_setup('course_customfield');

$output = $PAGE->get_renderer('core_customfield');
$handler = core_course\customfield\course_handler::create();
$outputpage = new \core_customfield\output\management($handler);

echo $output->header(),
     $output->heading(new lang_string('course_customfield', 'admin')),
     $output->render($outputpage),
     $output->footer();
