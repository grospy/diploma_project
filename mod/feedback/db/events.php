<?php
//

/**
 * Feedback event handler definition.
 *
 * @package mod_feedback
 * @category event
 * @copyright 2016 Marina Glancy
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// List of observers.
$observers = array(

    array(
        'eventname'   => '\core\event\course_content_deleted',
        'callback'    => 'mod_feedback_observer::course_content_deleted',
    ),

);
