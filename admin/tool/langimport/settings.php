<?php
//

/**
 * Lang import
 *
 * @package    tool
 * @subpackage langimport
 * @copyright  2011 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('language', new admin_externalpage('toollangimport', get_string('pluginname', 'tool_langimport'), "$CFG->wwwroot/$CFG->admin/tool/langimport/index.php"));
}

