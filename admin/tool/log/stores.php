<?php
//

/**
 * Logging store management.
 *
 * @package    tool_log
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$action = required_param('action', PARAM_ALPHANUMEXT);
$enrol = required_param('store', PARAM_PLUGIN);

$PAGE->set_url('/admin/tool/log/stores.php');
$PAGE->set_context(context_system::instance());

require_admin();
require_sesskey();

$all = \tool_log\log\manager::get_store_plugins();
$enabled = get_config('tool_log', 'enabled_stores');
if (!$enabled) {
    $enabled = array();
} else {
    $enabled = array_flip(explode(',', $enabled));
}

$return = new moodle_url('/admin/settings.php', array('section' => 'managelogging'));

$syscontext = context_system::instance();

switch ($action) {
    case 'disable':
        unset($enabled[$enrol]);
        set_config('enabled_stores', implode(',', array_keys($enabled)), 'tool_log');
        break;

    case 'enable':
        if (!isset($all[$enrol])) {
            break;
        }
        $enabled = array_keys($enabled);
        $enabled[] = $enrol;
        set_config('enabled_stores', implode(',', $enabled), 'tool_log');
        break;

    case 'up':
        if (!isset($enabled[$enrol])) {
            break;
        }
        $enabled = array_keys($enabled);
        $enabled = array_flip($enabled);
        $current = $enabled[$enrol];
        if ($current == 0) {
            break; // Already at the top.
        }
        $enabled = array_flip($enabled);
        $enabled[$current] = $enabled[$current - 1];
        $enabled[$current - 1] = $enrol;
        set_config('enabled_stores', implode(',', $enabled), 'tool_log');
        break;

    case 'down':
        if (!isset($enabled[$enrol])) {
            break;
        }
        $enabled = array_keys($enabled);
        $enabled = array_flip($enabled);
        $current = $enabled[$enrol];
        if ($current == count($enabled) - 1) {
            break; // Already at the end.
        }
        $enabled = array_flip($enabled);
        $enabled[$current] = $enabled[$current + 1];
        $enabled[$current + 1] = $enrol;
        set_config('enabled_stores', implode(',', $enabled), 'tool_log');
        break;
}

redirect($return);
