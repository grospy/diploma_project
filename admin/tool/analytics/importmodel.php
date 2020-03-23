<?php
//

/**
 * Import models tool frontend.
 *
 * @package tool_analytics
 * @copyright 2017 onwards Ankit Agarwal
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');

require_login();
\core_analytics\manager::check_can_manage_models();

if (!\core_analytics\manager::is_analytics_enabled()) {
    $PAGE->set_context(\context_system::instance());
    $renderer = $PAGE->get_renderer('tool_analytics');
    echo $renderer->render_analytics_disabled();
    exit(0);
}

$returnurl = new \moodle_url('/admin/tool/analytics/index.php');
$url = new \moodle_url('/admin/tool/analytics/importmodel.php');
$title = get_string('importmodel', 'tool_analytics');

\tool_analytics\output\helper::set_navbar($title, $url);

$form = new \tool_analytics\output\form\import_model();
if ($form->is_cancelled()) {
    redirect($returnurl);
} else if ($data = $form->get_data()) {

    $modelconfig = new \core_analytics\model_config();

    $zipfilepath = $form->save_temp_file('modelfile');

    list ($modeldata, $unused) = $modelconfig->extract_import_contents($zipfilepath);

    if ($error = $modelconfig->check_dependencies($modeldata, $data->ignoreversionmismatches)) {
        // The file is not available until the form is validated so we need an alternative method to show errors.
        redirect($url, $error, 0, \core\output\notification::NOTIFY_ERROR);
    }
    \core_analytics\model::import_model($zipfilepath);

    redirect($returnurl, get_string('importedsuccessfully', 'tool_analytics'), 0,
        \core\output\notification::NOTIFY_SUCCESS);
}

echo $OUTPUT->header();
$form->display();
echo $OUTPUT->footer();
