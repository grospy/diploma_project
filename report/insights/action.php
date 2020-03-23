<?php
//

/**
 * Forwards the user to the action they selected.
 *
 * @package    report_insights
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');

$predictionid = required_param('predictionid', PARAM_INT);
$actionname = required_param('action', PARAM_ALPHANUMEXT);
$forwardurl = required_param('forwardurl', PARAM_LOCALURL);

if (!\core_analytics\manager::is_analytics_enabled()) {
    $PAGE->set_context(\context_system::instance());
    $renderer = $PAGE->get_renderer('report_insights');
    echo $renderer->render_analytics_disabled();
    exit(0);
}

list($model, $prediction, $context) = \core_analytics\manager::get_prediction($predictionid, true);
if ($context->contextlevel < CONTEXT_COURSE) {
    // Only for higher levels than course.
    $PAGE->set_context($context);
}

if (empty($forwardurl)) {
    $params = array('modelid' => $model->get_id(), 'contextid' => $context->id);
    $forwardurl = new \moodle_url('/report/insights/insights.php', $params);
}

$params = array('predictionid' => $prediction->get_prediction_data()->id, 'action' => $actionname, 'forwardurl' => $forwardurl);
$url = new \moodle_url('/report/insights/action.php', $params);
$PAGE->set_url($url);

$modelready = $model->is_enabled() && $model->is_trained() && $model->predictions_exist($context);
if (!$modelready) {

    $PAGE->set_pagelayout('report');

    // We don't want to disclose the name of the model if it has not been enabled.
    $PAGE->set_title($context->get_context_name());
    $PAGE->set_heading($context->get_context_name());
    echo $OUTPUT->header();
    echo $OUTPUT->notification(get_string('disabledmodel', 'report_insights'), \core\output\notification::NOTIFY_INFO);
    echo $OUTPUT->footer();
    exit(0);
}

$prediction->action_executed($actionname, $model->get_target());

redirect($forwardurl);
