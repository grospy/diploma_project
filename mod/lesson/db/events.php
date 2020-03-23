<?php
//

/**
 * Add event handlers for the lesson
 *
 * @package    mod_lesson
 * @category   event
 * @copyright  2015 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

$observers = array(

    array(
        'eventname' => '\core\event\course_reset_started',
        'callback' => '\mod_lesson\group_observers::course_reset_started',
    ),
    array(
        'eventname' => '\core\event\course_reset_ended',
        'callback' => '\mod_lesson\group_observers::course_reset_ended',
    ),
    array(
        'eventname' => '\core\event\group_deleted',
        'callback' => '\mod_lesson\group_observers::group_deleted'
    ),
);
