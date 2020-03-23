<?php
//

/**
 * Page to export a competency framework as a CSV.
 *
 * @package    tool_lpimportcsv
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');

$pagetitle = get_string('exportnavlink', 'tool_lpimportcsv');

$context = context_system::instance();

$url = new moodle_url("/admin/tool/lpimportcsv/export.php");
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_title($pagetitle);
$PAGE->set_pagelayout('admin');
$PAGE->set_heading($pagetitle);

$form = new \tool_lpimportcsv\form\export($url->out(false), array('persistent' => null, 'context' => $context));

if ($form->is_cancelled()) {
    redirect(new moodle_url('/admin/tool/lp/competencyframeworks.php', array('pagecontextid' => $context->id)));
} else if ($data = $form->get_data()) {
    require_sesskey();

    $exporter = new \tool_lpimportcsv\framework_exporter($data->frameworkid);

    $exporter->export();
    die();
}

echo $OUTPUT->header();
echo $OUTPUT->heading($pagetitle);

$form->display();

echo $OUTPUT->footer();
