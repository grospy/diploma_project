<?php
//

/**
 * Definition of flatfile enrolment scheduled tasks.
 *
 * @package    enrol_flatfile
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\enrol_flatfile\task\flatfile_sync_task',
        'blocking' => 0,
        'minute' => '15',
        'hour' => '*',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    )
);
