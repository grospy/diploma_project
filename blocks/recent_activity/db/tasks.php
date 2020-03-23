<?php
//

/**
 * Task definition for block_recent_activity.
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali 2018
 * @package   block_recent_activity
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\block_recent_activity\task\cleanup',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => 'R',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    )
);

