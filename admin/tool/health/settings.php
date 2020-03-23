<?php
//

/**
 * Capability overview settings
 *
 * @package    tool
 * @subpackage health
 * @copyright  2011 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('unsupported', new admin_externalpage('toolhealth', get_string('pluginname', 'tool_health'), $CFG->wwwroot.'/'.$CFG->admin.'/tool/health/index.php', 'moodle/site:config', true));
}
