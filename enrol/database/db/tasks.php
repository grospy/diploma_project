<?php
//

/**
 * Task definition for enrol_database.
 * @package   enrol_database
 * @copyright 2018 Daniel Neis Araujo <danielneis@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\enrol_database\task\sync_enrolments',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => 'R',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 1
    )
);
