<?php
//

/**
 * Legacy log reader cron task.
 *
 * @package    logstore_legacy
 * @copyright  2014 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\logstore_legacy\task\cleanup_task',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => '5',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ),
);