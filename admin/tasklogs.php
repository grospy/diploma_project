<?php
//

/**
 * Task log.
 *
 * @package    admin
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../config.php');
require_once("{$CFG->libdir}/adminlib.php");
require_once("{$CFG->libdir}/tablelib.php");
require_once("{$CFG->libdir}/filelib.php");

$filter = optional_param('filter', '', PARAM_RAW);
$result = optional_param('result', null, PARAM_INT);

$pageurl = new \moodle_url('/admin/tasklogs.php');
$pageurl->param('filter', $filter);

$PAGE->set_url($pageurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$strheading = get_string('tasklogs', 'tool_task');
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

admin_externalpage_setup('tasklogs');

$logid = optional_param('logid', null, PARAM_INT);
$download = optional_param('download', false, PARAM_BOOL);

if (null !== $logid) {
    // Raise memory limit in case the log is large.
    raise_memory_limit(MEMORY_HUGE);
    $log = $DB->get_record('task_log', ['id' => $logid], '*', MUST_EXIST);

    if ($download) {
        $filename = str_replace('\\', '_', $log->classname) . "-{$log->id}.log";
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
    }

    readstring_accel($log->output, 'text/plain');
    exit;
}

$renderer = $PAGE->get_renderer('tool_task');

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('core_admin/tasklogs', (object) [
    'action' => $pageurl->out(),
    'filter' => $filter,
    'resultfilteroptions' => [
        (object) [
            'value' => -1,
            'title' => get_string('all'),
            'selected' => (-1 === $result),
        ],
        (object) [
            'value' => 0,
            'title' => get_string('success'),
            'selected' => (0 === $result),
        ],
        (object) [
            'value' => 1,
            'title' => get_string('task_result:failed', 'admin'),
            'selected' => (1 === $result),
        ],
    ],
]);

$table = new \core_admin\task_log_table($filter, $result);
$table->baseurl = $pageurl;
$table->out(100, false);

echo $OUTPUT->footer();
