<?php
//

/**
 * Enables the provided model.
 *
 * @package    tool_analytics
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

require_once(__DIR__ . '/../../../../config.php');
require_once($CFG->libdir.'/clilib.php');

$help = "Enables the provided model.

Options:
--modelid           Model id
--list              List models
--analysisinterval  Time splitting method full class name
-h, --help          Print out this help

Example:
\$ php admin/tool/analytics/cli/enable_model.php --modelid=1 --analysisinterval=\"\\core\\analytics\\time_splitting\\quarters\"
";

// Now get cli options.
list($options, $unrecognized) = cli_get_params(
    array(
        'help'             => false,
        'list'             => false,
        'modelid'          => false,
        'analysisinterval' => false
    ),
    array(
        'h' => 'help',
    )
);

if ($options['help']) {
    echo $help;
    exit(0);
}

if (!\core_analytics\manager::is_analytics_enabled()) {
    echo get_string('analyticsdisabled', 'analytics') . PHP_EOL;
    exit(0);
}

if ($options['list'] || $options['modelid'] === false) {
    \tool_analytics\clihelper::list_models();
    exit(0);
}

if ($options['analysisinterval'] === false) {
    echo $help;
    exit(0);
}

// We need admin permissions.
\core\session\manager::set_user(get_admin());

$model = new \core_analytics\model($options['modelid']);

// Evaluate its suitability to predict accurately.
$model->enable($options['analysisinterval']);

cli_heading(get_string('success'));
exit(0);
