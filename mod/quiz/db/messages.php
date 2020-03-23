<?php
//

/**
 * Defines message providers (types of message sent) for the quiz module.
 *
 * @package   mod_quiz
 * @copyright 2010 Andrew Davis http://moodle.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$messageproviders = array(
    // Notify teacher that a student has submitted a quiz attempt.
    'submission' => array(
        'capability' => 'mod/quiz:emailnotifysubmission'
    ),

    // Confirm a student's quiz attempt.
    'confirmation' => array(
        'capability' => 'mod/quiz:emailconfirmsubmission',
        'defaults' => array(
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
    ),

    // Warning to the student that their quiz attempt is now overdue, if the quiz
    // has a grace period.
    'attempt_overdue' => array(
        'capability' => 'mod/quiz:emailwarnoverdue',
        'defaults' => array(
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
    ),
);
