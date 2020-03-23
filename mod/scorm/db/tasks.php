<?php
//

/**
 * Definition of Forum scheduled tasks.
 *
 * @package   mod_scorm
 * @category  task
 * @copyright 2017 Abhishek kumar <ganitgenius@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'mod_scorm\task\cron_task',
        'blocking' => 0,
        'minute' => '*/5',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*'
    )
);