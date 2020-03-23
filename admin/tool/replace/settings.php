<?php
//

/**
 * Link to unsupported db replace script.
 *
 * @package    tool
 * @subpackage replace
 * @copyright  2011 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('unsupported', new admin_externalpage('toolreplace', get_string('pluginname', 'tool_replace'), $CFG->wwwroot.'/'.$CFG->admin.'/tool/replace/index.php', 'moodle/site:config', true));
}
