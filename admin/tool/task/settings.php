<?php
//

/**
 * Scheduled tasks.
 *
 * @package    tool_task
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add(
        'taskconfig',
        new admin_externalpage(
            'scheduledtasks',
            new lang_string('scheduledtasks', 'tool_task'),
            "$CFG->wwwroot/$CFG->admin/tool/task/scheduledtasks.php"
        )
    );
}
