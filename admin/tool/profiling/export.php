<?php
//

/**
 * Profiling tool export utility.
 *
 * @package    tool_profiling
 * @copyright  2013 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir . '/xhprof/xhprof_moodle.php');

// Page parameters.
$runid = required_param('runid', PARAM_ALPHANUM);
$listurl = required_param('listurl', PARAM_PATH);

admin_externalpage_setup('toolprofiling');

$PAGE->navbar->add(get_string('export', 'tool_profiling'));

// Calculate export variables.
$tempdir = 'profiling';
make_temp_directory($tempdir);
$runids = array($runid);
$filename = $runid . '.mpr';
$filepath = $CFG->tempdir . '/' . $tempdir . '/' . $filename;

// Generate the mpr file and send it.
if (profiling_export_runs($runids, $filepath)) {
    send_file($filepath, $filename, 0, 0, false, false, '', true);
    unlink($filepath); // Delete once sent.
    die;
}

// Something wrong happened, notice it and done.
$urlparams = array(
        'runid' => $runid,
        'listurl' => $listurl);
$url = new moodle_url('/admin/tool/profiling/index.php', $urlparams);
notice(get_string('exportproblem', 'tool_profiling', $urlparams), $url);
