<?php
//

/**
 * @package    tool
 * @subpackage customlang
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$ADMIN->add('language', new admin_externalpage('toolcustomlang', get_string('pluginname', 'tool_customlang'), "$CFG->wwwroot/$CFG->admin/tool/customlang/index.php", 'tool/customlang:view'));
