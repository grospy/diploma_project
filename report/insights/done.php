<?php
//

/**
 * Forwards the user to the action they selected.
 *
 * @package    report_insights
 * @copyright  2019 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');

require_login();

$actionvisiblename = required_param('actionvisiblename', PARAM_NOTAGS);

$PAGE->set_pagelayout('popup');
$PAGE->set_context(\context_system::instance());

if (!\core_analytics\manager::is_analytics_enabled()) {
    $renderer = $PAGE->get_renderer('report_insights');
    echo $renderer->render_analytics_disabled();
    exit(0);
}

$PAGE->set_title(get_site()->fullname);
$PAGE->set_url(new \moodle_url('/report/insights/done.php'));

echo $OUTPUT->header();

$notification = new \core\output\notification(get_string('actionsaved', 'report_insights', $actionvisiblename),
    \core\output\notification::NOTIFY_SUCCESS);
$notification->set_show_closebutton(false);
echo $OUTPUT->render($notification);

echo $OUTPUT->footer();
