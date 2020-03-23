<?php
//

/**
 * Allows the admin to manage assignment plugins
 *
 * @package    mod_assign
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/mod/assign/adminlib.php');

$subtype = required_param('subtype', PARAM_PLUGIN);
$action = optional_param('action', null, PARAM_PLUGIN);
$plugin = optional_param('plugin', null, PARAM_PLUGIN);

if (!empty($plugin)) {
    require_sesskey();
}

// Create the class for this controller.
$pluginmanager = new assign_plugin_manager($subtype);

$PAGE->set_context(context_system::instance());

// Execute the controller.
$pluginmanager->execute($action, $plugin);
