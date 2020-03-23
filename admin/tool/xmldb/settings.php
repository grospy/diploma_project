<?php
//

/**
 * Link to xmldb editor
 *
 * @package    tool_xmldb
 * @copyright  2003 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('development', new admin_externalpage('toolxmld', get_string('pluginname', 'tool_xmldb'), "$CFG->wwwroot/$CFG->admin/tool/xmldb/"));
}
