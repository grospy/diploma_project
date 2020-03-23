<?php
//

/**
 * Links and settings
 *
 * This file contains links and settings used by tool_monitor
 *
 * @package    tool_monitor
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

// Manage rules page.
$temp = new admin_externalpage(
    'toolmonitorrules',
    get_string('managerules', 'tool_monitor'),
    new moodle_url('/admin/tool/monitor/managerules.php', array('courseid' => 0)),
    'tool/monitor:managerules'
);
$ADMIN->add('reports', $temp);
