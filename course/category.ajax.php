<?php
//

/**
 * Helps moodle-course-categoryexpander to serve AJAX requests
 *
 * @see core_course_renderer::coursecat_include_js()
 * @see core_course_renderer::coursecat_ajax()
 *
 * @package   core
 * @copyright 2013 Andrew Nicols
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../config.php');

if ($CFG->forcelogin) {
    require_login();
}

$PAGE->set_context(context_system::instance());
$courserenderer = $PAGE->get_renderer('core', 'course');

echo json_encode($courserenderer->coursecat_ajax());
