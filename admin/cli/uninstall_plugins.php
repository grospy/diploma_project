<?php
//

/**
 * CLI script to uninstall plugins.
 *
 * @package    core
 * @subpackage cli
 * @copyright  2018 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/clilib.php');
require_once($CFG->libdir . '/adminlib.php');

$help = "Command line tool to uninstall plugins.

Options:
    -h --help                   Print this help.
    --show-all                  Displays a list of all installed plugins.
    --show-missing              Displays a list of plugins missing from disk.
    --purge-missing             Uninstall all missing from disk plugins.
    --plugins=<plugin name>     A comma separated list of plugins to be uninstalled. E.g. mod_assign,mod_forum
    --run                       Execute uninstall. If this option is not set, then the script will be run in a dry mode.

Examples:

    # php uninstall_plugins.php  --show-all
        Prints tab-separated list of all installed plugins.

    # php uninstall_plugins.php  --show-missing
        Prints tab-separated list of all missing from disk plugins.

    # php uninstall_plugins.php  --purge-missing
        A dry run of uninstalling all missing plugins.

    # php uninstall_plugins.php  --purge-missing --run
        Run uninstall of all missing plugins.

    # php uninstall_plugins.php  --plugins=mod_assign,mod_forum
        A dry run of uninstalling mod_assign and mod_forum plugins.

    # php uninstall_plugins.php  --plugins=mod_assign,mod_forum --run
        Run uninstall for mod_assign and mod_forum plugins.
";

list($options, $unrecognised) = cli_get_params([
    'help' => false,
    'show-all' => false,
    'show-missing' => false,
    'purge-missing' => false,
    'plugins' => false,
    'run' => false,
], [
    'h' => 'help'
]);

if ($unrecognised) {
    $unrecognised = implode(PHP_EOL.'  ', $unrecognised);
    cli_error(get_string('cliunknowoption', 'core_admin', $unrecognised));
}

if ($options['help']) {
    cli_writeln($help);
    exit(0);
}

$pluginman = core_plugin_manager::instance();
$plugininfo = $pluginman->get_plugins();

if ($options['show-all'] || $options['show-missing']) {
    foreach ($plugininfo as $type => $plugins) {
        foreach ($plugins as $name => $plugin) {
            $pluginstring = $plugin->component . "\t" . $plugin->displayname;

            if ($options['show-all']) {
                cli_writeln($pluginstring);
            } else {
                if ($plugin->get_status() === core_plugin_manager::PLUGIN_STATUS_MISSING) {
                    cli_writeln($pluginstring);
                }
            }
        }
    }

    exit(0);
}

if ($options['purge-missing']) {
    foreach ($plugininfo as $type => $plugins) {
        foreach ($plugins as $name => $plugin) {
            if ($plugin->get_status() === core_plugin_manager::PLUGIN_STATUS_MISSING) {

                $pluginstring = $plugin->component . "\t" . $plugin->displayname;

                if ($pluginman->can_uninstall_plugin($plugin->component)) {
                    if ($options['run']) {
                        cli_writeln('Uninstalling: ' . $pluginstring);

                        $progress = new progress_trace_buffer(new text_progress_trace(), true);
                        $pluginman->uninstall_plugin($plugin->component, $progress);
                        $progress->finished();
                        cli_write($progress->get_buffer());
                    } else {
                        cli_writeln('Will be uninstalled: ' . $pluginstring);
                    }
                } else {
                    cli_writeln('Can not be uninstalled: ' . $pluginstring);
                }
            }
        }
    }

    exit(0);
}

if ($options['plugins']) {
    $components = explode(',', $options['plugins']);
    foreach ($components as $component) {
        $plugin = $pluginman->get_plugin_info($component);

        if (is_null($plugin)) {
            cli_writeln('Unknown plugin: ' . $component);
        } else {
            $pluginstring = $plugin->component . "\t" . $plugin->displayname;

            if ($pluginman->can_uninstall_plugin($plugin->component)) {
                if ($options['run']) {
                    cli_writeln('Uninstalling: ' . $pluginstring);
                    $progress = new progress_trace_buffer(new text_progress_trace(), true);
                    $pluginman->uninstall_plugin($plugin->component, $progress);
                    $progress->finished();
                    cli_write($progress->get_buffer());
                } else {
                    cli_writeln('Will be uninstalled: ' . $pluginstring);
                }
            } else {
                cli_writeln('Can not be uninstalled: ' . $pluginstring);
            }
        }
    }

    exit(0);
}

cli_writeln($help);
exit(0);
