<?php
//

/**
 * This page lets users to manage site wide competencies.
 *
 * @package    tool_templatelibrary
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');

admin_externalpage_setup('tooltemplatelibrary');

$component = optional_param('component', '', PARAM_COMPONENT);
$search = optional_param('search', '', PARAM_RAW);

$title = get_string('templates', 'tool_templatelibrary');
$pagetitle = get_string('searchtemplates', 'tool_templatelibrary');
// Set up the page.
$url = new moodle_url("/admin/tool/templatelibrary/index.php", array('component' => $component, 'search' => $search));
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$output = $PAGE->get_renderer('tool_templatelibrary');
echo $output->header();
echo $output->heading($pagetitle);

$page = new \tool_templatelibrary\output\list_templates_page($component, $search);
echo $output->render($page);

echo $output->footer();
