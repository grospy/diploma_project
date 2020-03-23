<?php
//

/**
 * Admin settings and defaults.
 *
 * @package    auth_mnet
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once($CFG->dirroot.'/lib/outputlib.php');

    // Introductory explanation.
    $settings->add(new admin_setting_heading('auth_mnet/pluginname', '',
            new lang_string('auth_mnetdescription', 'auth_mnet')));

    // RPC Timeout.
    $settings->add(new admin_setting_configtext('auth_mnet/rpc_negotiation_timeout',
            get_string('rpc_negotiation_timeout', 'auth_mnet'),
            get_string('auth_mnet_rpc_negotiation_timeout', 'auth_mnet'), '30', PARAM_INT));

}
