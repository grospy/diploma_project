<?php
//

/**
 * Prints the compliance data registry main page.
 *
 * @copyright 2018 onwards Adrian Greeve <adriangreeve.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package tool_dataprivacy
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/' . $CFG->admin . '/tool/dataprivacy/lib.php');

$url = new moodle_url('/' . $CFG->admin . '/tool/dataprivacy/summary.php');
$title = get_string('summary', 'tool_dataprivacy');

$context = \context_system::instance();
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($SITE->fullname);

// If user is logged in, then use profile navigation in breadcrumbs.
if ($profilenode = $PAGE->settingsnav->find('myprofile', null)) {
    $profilenode->make_active();
}

$PAGE->navbar->add($title);

$output = $PAGE->get_renderer('tool_dataprivacy');
echo $output->header();
$summarypage = new \tool_dataprivacy\output\summary_page();
echo $output->render($summarypage);
echo $output->footer();
