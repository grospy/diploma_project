<?php
//

/**
 * Link to CSV user upload
 *
 * @package    tool
 * @subpackage uploaduser
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('accounts', new admin_externalpage('tooluploaduser', get_string('uploadusers', 'tool_uploaduser'), "$CFG->wwwroot/$CFG->admin/tool/uploaduser/index.php", 'moodle/site:uploadusers'));
$ADMIN->add('accounts', new admin_externalpage('tooluploaduserpictures', get_string('uploadpictures','tool_uploaduser'), "$CFG->wwwroot/$CFG->admin/tool/uploaduser/picture.php", 'tool/uploaduser:uploaduserpictures'));
