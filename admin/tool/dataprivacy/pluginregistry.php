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

require_login(null, false);

$contextlevel = optional_param('contextlevel', CONTEXT_SYSTEM, PARAM_INT);
$contextid = optional_param('contextid', 0, PARAM_INT);

$url = new moodle_url('/' . $CFG->admin . '/tool/dataprivacy/pluginregistry.php');
$title = get_string('pluginregistry', 'tool_dataprivacy');

\tool_dataprivacy\page_helper::setup($url, $title);

$output = $PAGE->get_renderer('tool_dataprivacy');
echo $output->header();

if (\tool_dataprivacy\api::is_site_dpo($USER->id)) {
    // Get data!
    $metadatatool = new \tool_dataprivacy\metadata_registry();
    $metadata = $metadatatool->get_registry_metadata();

    $dataregistry = new tool_dataprivacy\output\data_registry_compliance_page($metadata);

    echo $output->render($dataregistry);
} else {
    $dponamestring = implode (', ', tool_dataprivacy\api::get_dpo_role_names());
    $message = get_string('privacyofficeronly', 'tool_dataprivacy', $dponamestring);
    echo $OUTPUT->notification($message, 'error');
}

echo $OUTPUT->footer();
