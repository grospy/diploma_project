<?php
//

/**
 * Definition of IMS Enterprise enrolment scheduled tasks.
 *
 * @package   enrol_imsenterprise
 * @category  task
 * @copyright 2014 Universite de Montreal
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'enrol_imsenterprise\task\cron_task',
        'blocking' => 0,
        'minute' => '10',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*'
    )
);
