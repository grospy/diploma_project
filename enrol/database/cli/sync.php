<?php
//

/**
 * CLI sync for full external database synchronisation.
 *
 * Sample cron entry:
 * # 5 minutes past 4am
 * 5 4 * * * $sudo -u www-data /usr/bin/php /var/www/moodle/enrol/database/cli/sync.php
 *
 * Notes:
 *   - it is required to use the web server account when executing PHP CLI scripts
 *   - you need to change the "www-data" to match the apache user account
 *   - use "su" if "sudo" not available
 *
 * @deprecated since Moodle 3.7 MDL-59986 - please do not use this CLI script any more, use scheduled task instead.
 * @todo       MDL-63266 This will be deleted in Moodle 4.1.
 * @package    enrol_database
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

require(__DIR__.'/../../../config.php');
require_once("$CFG->libdir/clilib.php");

// Now get cli options.
list($options, $unrecognized) = cli_get_params(array('verbose'=>false, 'help'=>false), array('v'=>'verbose', 'h'=>'help'));

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}

if ($options['help']) {
    $help =
"Execute enrol sync with external database.
The enrol_database plugin must be enabled and properly configured.

Options:
-v, --verbose         Print verbose progress information
-h, --help            Print out this help

Example:
\$ sudo -u www-data /usr/bin/php enrol/database/cli/sync.php

Sample cron entry:
# 5 minutes past 4am
5 4 * * * sudo -u www-data /usr/bin/php /var/www/moodle/enrol/database/cli/sync.php
";

    echo $help;
    die;
}

cli_problem('[ENROL DATABASE] The sync enrolments cron script has been deprecated. Please use the scheduled task instead.');

// Abort execution of the CLI script if the enrol_database\task\sync_enrolments is enabled.
$task = \core\task\manager::get_scheduled_task('enrol_database\task\sync_enrolments');
if (!$task->get_disabled()) {
    cli_error('[ENROL DATABASE] The scheduled task sync_enrolments is enabled, the cron execution has been aborted.');
}

if (!enrol_is_enabled('database')) {
    cli_error('enrol_database plugin is disabled, synchronisation stopped', 2);
}

if (empty($options['verbose'])) {
    $trace = new null_progress_trace();
} else {
    $trace = new text_progress_trace();
}

/** @var enrol_database_plugin $enrol  */
$enrol = enrol_get_plugin('database');
$result = 0;

$result = $result | $enrol->sync_courses($trace);
$result = $result | $enrol->sync_enrolments($trace);

exit($result);
