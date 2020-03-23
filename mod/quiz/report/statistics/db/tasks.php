<?php
//

/**
 * Legacy Cron Quiz Reports Task
 *
 * @package    quiz_statistics
 * @copyright  2017 Michael Hughes, University of Strathclyde
 * @author Michael Hughes <michaelhughes@strath.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

defined('MOODLE_INTERNAL') || die();

$tasks = [
    [
        'classname' => 'quiz_statistics\task\quiz_statistics_cleanup',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => '*/5',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ]
];
