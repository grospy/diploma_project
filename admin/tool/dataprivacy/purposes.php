<?php
//

/**
 * This page lets users manage purposes.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');

require_login(null, false);

$url = new moodle_url("/admin/tool/dataprivacy/purposes.php");
$title = get_string('editpurposes', 'tool_dataprivacy');

\tool_dataprivacy\page_helper::setup($url, $title, 'dataregistry');

$output = $PAGE->get_renderer('tool_dataprivacy');
echo $output->header();
echo $output->heading($title);

$purposes = \tool_dataprivacy\api::get_purposes();
$renderable = new \tool_dataprivacy\output\purposes($purposes);

echo $output->render($renderable);
echo $output->footer();
