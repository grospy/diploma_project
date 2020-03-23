<?php
//

/**
 * Link to CSV course upload.
 *
 * @package    tool_uploadcourse
 * @copyright  2011 Piers Harding
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN->add('courses', new admin_externalpage('tooluploadcourse',
        get_string('uploadcourses', 'tool_uploadcourse'), "$CFG->wwwroot/$CFG->admin/tool/uploadcourse/index.php"));
}
