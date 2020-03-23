<?php
//

/**
 * Link to unsupported roles tool
 *
 * @package    tool
 * @subpackage unsuproles
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('roles', new admin_externalpage('toolunsuproles', get_string('pluginname', 'tool_unsuproles'), "$CFG->wwwroot/$CFG->admin/tool/unsuproles/index.php", array('moodle/site:config', 'moodle/role:assign')));
}
