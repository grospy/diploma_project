<?php
//

/**
 * CLI script to kill all user sessions without asking for confirmation.
 *
 * @package    core
 * @subpackage cli
 * @copyright  2017 Alexander Bias <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

require(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/clilib.php');

list($options, $unrecognized) = cli_get_params(array('help' => false), array('h' => 'help'));

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized), 2);
}

if ($options['help']) {
    $help =
"Kill all Moodle sessions

Options:
-h, --help            Print out this help

Example:
\$sudo -u www-data /usr/bin/php admin/cli/kill_all_sessions.php
";

    echo $help;
    exit(0);
}

\core\session\manager::kill_all_sessions();

exit(0);
