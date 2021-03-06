<?php
//

/**
 * This file definies observers needed by the tool.
 *
 * @package    tool_monitor
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// List of observers.
$observers = array(
    array(
        'eventname'   => '\core\event\course_deleted',
        'priority'    => 1,
        'callback'    => '\tool_monitor\eventobservers::course_deleted',
    ),
    array(
        'eventname'   => '*',
        'callback'    => '\tool_monitor\eventobservers::process_event',
    ),
    array(
        'eventname'   => '\core\event\user_deleted',
        'callback'    => '\tool_monitor\eventobservers::user_deleted',
    ),
    array(
        'eventname'   => '\core\event\course_module_deleted',
        'callback'    => '\tool_monitor\eventobservers::course_module_deleted',
    )
);
