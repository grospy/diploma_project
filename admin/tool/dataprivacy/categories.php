<?php
//

/**
 * This page lets users manage categories.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');

require_login(null, false);

$url = new moodle_url("/admin/tool/dataprivacy/categories.php");
$title = get_string('editcategories', 'tool_dataprivacy');

\tool_dataprivacy\page_helper::setup($url, $title, 'dataregistry');

$output = $PAGE->get_renderer('tool_dataprivacy');
echo $output->header();
echo $output->heading($title);

$categories = \tool_dataprivacy\api::get_categories();
$renderable = new \tool_dataprivacy\output\categories($categories);

echo $output->render($renderable);
echo $output->footer();
