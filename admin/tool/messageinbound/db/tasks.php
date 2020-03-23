<?php
//

/**
 * The Main Manager tasks.
 *
 * @package    tool_messageinbound
 * @copyright  2014 Andrew Nicols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\tool_messageinbound\task\pickup_task',
        'blocking' => 0,
        'minute' => '*',
        'hour' => '*',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ),

    array(
        'classname' => '\tool_messageinbound\task\cleanup_task',
        'blocking' => 0,
        'minute' => '55',
        'hour' => '1',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ),
);
