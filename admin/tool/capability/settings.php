<?php
//

/**
 * Capability overview settings
 *
 * @package    tool_capability
 * @copyright  2008 Tim Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('roles', new admin_externalpage(
    'toolcapability',
    get_string('pluginname', 'tool_capability'),
    "$CFG->wwwroot/$CFG->admin/tool/capability/index.php",
    'moodle/role:manage'
));
