<?php
//

/**
 * Event observer.
 *
 * @package   block_recent_activity
 * @category  event
 * @copyright 2014 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = array (
    array (
        'eventname' => '\core\event\course_module_created',
        'callback'  => 'block_recent_activity_observer::store',
        'internal'  => false, // This means that we get events only after transaction commit.
        'priority'  => 1000,
    ),
    array (
        'eventname' => '\core\event\course_module_updated',
        'callback'  => 'block_recent_activity_observer::store',
        'internal'  => false, // This means that we get events only after transaction commit.
        'priority'  => 1000,
    ),
    array (
        'eventname' => '\core\event\course_module_deleted',
        'callback'  => 'block_recent_activity_observer::store',
        'internal'  => false, // This means that we get events only after transaction commit.
        'priority'  => 1000,
    ),
);
