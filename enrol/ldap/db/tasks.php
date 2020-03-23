<?php
//

/**
 * Task definition for enrol_ldap.
 * @author    Guy Thomas <gthomas@moodlerooms.com>
 * @copyright Copyright (c) 2017 Blackboard Inc.
 * @package   enrol_ldap
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\enrol_ldap\task\sync_enrolments',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => 'R',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 1
    )
);

