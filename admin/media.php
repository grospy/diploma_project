<?php
//

/**
 * Enrol config manipulation script.
 *
 * @package    core
 * @subpackage media
 * @copyright  2016 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_OUTPUT_BUFFERING', true);

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');

$action  = required_param('action', PARAM_ALPHANUMEXT);
$media   = required_param('media', PARAM_PLUGIN);
$confirm = optional_param('confirm', 0, PARAM_BOOL);

$PAGE->set_url('/admin/media.php');
$PAGE->set_context(context_system::instance());

require_admin();
require_sesskey();

$plugins = core_plugin_manager::instance()->get_plugins_of_type('media');
$sortorder = array_values(\core\plugininfo\media::get_enabled_plugins());

$return = new moodle_url('/admin/settings.php', array('section' => 'managemediaplayers'));

if (!array_key_exists($media, $plugins)) {
    redirect($return);
}

switch ($action) {
    case 'disable':
        $plugins[$media]->set_enabled(false);
        break;

    case 'enable':
        $plugins[$media]->set_enabled(true);
        break;

    case 'up':
        if (($pos = array_search($media, $sortorder)) > 0) {
            $tmp = $sortorder[$pos - 1];
            $sortorder[$pos - 1] = $sortorder[$pos];
            $sortorder[$pos] = $tmp;
            \core\plugininfo\media::set_enabled_plugins($sortorder);
        }
        break;

    case 'down':
        if ((($pos = array_search($media, $sortorder)) !== false) && ($pos < count($sortorder) - 1)) {
            $tmp = $sortorder[$pos + 1];
            $sortorder[$pos + 1] = $sortorder[$pos];
            $sortorder[$pos] = $tmp;
            \core\plugininfo\media::set_enabled_plugins($sortorder);
        }
        break;
}

redirect($return);
