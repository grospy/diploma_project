<?php
//

/**
 * Task definition for enrol_manual.
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @package   enrol_manual
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\enrol_manual\task\sync_enrolments',
        'blocking' => 0,
        'minute' => '*/10',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ),
    array(
        'classname' => '\enrol_manual\task\send_expiry_notifications',
        'blocking' => 0,
        'minute' => '*/10',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    )
);

