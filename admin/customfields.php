<?php
//

/**
 * Allows the admin to enable, disable and uninstall custom fields
 *
 * @package    core_admin
 * @copyright  2018 Daniel Neis Araujo
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');

$action  = required_param('action', PARAM_ALPHANUMEXT);
$customfieldname = required_param('field', PARAM_PLUGIN);

$syscontext = context_system::instance();
$PAGE->set_url('/admin/customfields.php');
$PAGE->set_context($syscontext);

require_admin();
require_sesskey();

$return = new moodle_url('/admin/settings.php', array('section' => 'managecustomfields'));

$customfieldplugins = core_plugin_manager::instance()->get_plugins_of_type('customfield');
$sortorder = array_flip(array_keys($customfieldplugins));

if (!isset($customfieldplugins[$customfieldname])) {
    print_error('customfieldnotfound', 'error', $return, $customfieldname);
}

switch ($action) {
    case 'disable':
        if ($customfieldplugins[$customfieldname]->is_enabled()) {
            set_config('disabled', 1, 'customfield_'. $customfieldname);
            core_plugin_manager::reset_caches();
        }
        break;
    case 'enable':
        if (!$customfieldplugins[$customfieldname]->is_enabled()) {
            unset_config('disabled', 'customfield_'. $customfieldname);
            core_plugin_manager::reset_caches();
        }
        break;
}
redirect($return);
