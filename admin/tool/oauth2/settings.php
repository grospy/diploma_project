<?php
//

/**
 * Oauth2 system configuration.
 *
 * @package    tool_oauth2
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('server', new admin_externalpage('oauth2', new lang_string('pluginname', 'tool_oauth2'),
         "$CFG->wwwroot/$CFG->admin/tool/oauth2/issuers.php"));
}
