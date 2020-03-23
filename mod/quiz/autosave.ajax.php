<?php
//

/**
 * Thisscript processes ajax auto-save requests during the quiz.
 *
 * @package    mod_quiz
 * @copyright  2013 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');

// Remember the current time as the time any responses were submitted
// (so as to make sure students don't get penalized for slow processing on this page).
$timenow = time();
require_sesskey();

// Get submitted parameters.
$attemptid = required_param('attempt',  PARAM_INT);
$thispage  = optional_param('thispage', 0, PARAM_INT);
$cmid      = optional_param('cmid', null, PARAM_INT);

$transaction = $DB->start_delegated_transaction();
$attemptobj = quiz_create_attempt_handling_errors($attemptid, $cmid);

// Check login.
require_login($attemptobj->get_course(), false, $attemptobj->get_cm());

// Check that this attempt belongs to this user.
if ($attemptobj->get_userid() != $USER->id) {
    throw new moodle_quiz_exception($attemptobj->get_quizobj(), 'notyourattempt');
}

// Check capabilities.
if (!$attemptobj->is_preview_user()) {
    $attemptobj->require_capability('mod/quiz:attempt');
}

// If the attempt is already closed, send them to the review page.
if ($attemptobj->is_finished()) {
    throw new moodle_quiz_exception($attemptobj->get_quizobj(),
            'attemptalreadyclosed', null, $attemptobj->review_url());
}

$attemptobj->process_auto_save($timenow);
$transaction->allow_commit();
echo 'OK';
