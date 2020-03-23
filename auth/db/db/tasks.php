<?php
//

/**
 * Task definition for auth_db.
 * @author    Guy Thomas <gthomas@moodlerooms.com>
 * @copyright Copyright (c) 2017 Blackboard Inc.
 * @package   auth_db
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\auth_db\task\sync_users',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => 'R',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 1
    )
);
