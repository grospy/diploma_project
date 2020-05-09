<?php

//

/**
 * Action for processing page answers by users
 *
 * @package mod_lesson
 * @copyright  2009 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/

/** Require the specific libraries */
require_once("../../config.php");
require_once($CFG->dirroot.'/mod/lesson/locallib.php');

$id = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('lesson', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$lesson = new lesson($DB->get_record('lesson', array('id' => $cm->instance), '*', MUST_EXIST), $cm, $course);

require_login($course, false, $cm);
require_sesskey();

// Apply overrides.
$lesson->update_effective_access($USER->id);

$context = $lesson->context;
$canmanage = $lesson->can_manage();
$lessonoutput = $PAGE->get_renderer('mod_lesson');

$url = new moodle_url('/mod/lesson/continue.php', array('id'=>$cm->id));
$PAGE->set_url($url);
$PAGE->set_pagetype('mod-lesson-view');
$PAGE->navbar->add(get_string('continue', 'lesson'));

// This is the code updates the lesson time for a timed test
// get time information for this user
if (!$canmanage) {
    $lesson->displayleft = lesson_displayleftif($lesson);
    $timer = $lesson->update_timer();
    if (!$lesson->check_time($timer)) {
        redirect(new moodle_url('/mod/lesson/view.php', array('id' => $cm->id, 'pageid' => LESSON_EOL, 'outoftime' => 'normal')));
        die; // Shouldn't be reached, but make sure.
    }
} else {
    $timer = new stdClass;
}

// record answer (if necessary) and show response (if none say if answer is correct or not)
$page = $lesson->load_page(required_param('pageid', PARAM_INT));

$reviewmode = $lesson->is_in_review_mode();

// Process the page responses.
$result = $lesson->process_page_responses($page);

if ($result->nodefaultresponse || $result->inmediatejump) {
    // Don't display feedback or force a redirecto to newpageid.
    redirect(new moodle_url('/mod/lesson/view.php', array('id'=>$cm->id,'pageid'=>$result->newpageid)));
}

// Set Messages.
$lesson->add_messages_on_page_process($page, $result, $reviewmode);

$PAGE->set_url('/mod/lesson/view.php', array('id' => $cm->id, 'pageid' => $page->id));
$PAGE->set_subpage($page->id);

/// Print the header, heading and tabs
lesson_add_fake_blocks($PAGE, $cm, $lesson, $timer);
echo $lessonoutput->header($lesson, $cm, 'view', true, $page->id, get_string('continue', 'lesson'));

if ($lesson->displayleft) {
    echo '<a name="maincontent" id="maincontent" title="'.get_string('anchortitle', 'lesson').'"></a>';
}
// This calculates and prints the ongoing score message
if ($lesson->ongoing && !$reviewmode) {
    echo $lessonoutput->ongoing_score($lesson);
}
if (!$reviewmode) {
    echo format_text($result->feedback, FORMAT_MOODLE, array('context' => $context, 'noclean' => true));
}

// User is modifying attempts - save button and some instructions
if (isset($USER->modattempts[$lesson->id])) {
    $content = $OUTPUT->box(get_string("gotoendoflesson", "lesson"), 'center');
    $content .= $OUTPUT->box(get_string("or", "lesson"), 'center');
    $content .= $OUTPUT->box(get_string("continuetonextpage", "lesson"), 'center');
    $url = new moodle_url('/mod/lesson/view.php', array('id' => $cm->id, 'pageid' => LESSON_EOL));
    echo $content . $OUTPUT->single_button($url, get_string('finish', 'lesson'));
}

// Review button back
if (!$result->correctanswer && !$result->noanswer && !$result->isessayquestion && !$reviewmode && $lesson->review && !$result->maxattemptsreached) {
    $url = new moodle_url('/mod/lesson/view.php', array('id' => $cm->id, 'pageid' => $page->id));
    echo $OUTPUT->single_button($url, get_string('reviewquestionback', 'lesson'));
}

$url = new moodle_url('/mod/lesson/view.php', array('id'=>$cm->id, 'pageid'=>$result->newpageid));

if ($lesson->review && !$result->correctanswer && !$result->noanswer && !$result->isessayquestion && !$result->maxattemptsreached) {
    // If both the "Yes, I'd like to try again" and "No, I just want to go on  to the next question" point to the same
    // page then don't show the "No, I just want to go on to the next question" button. It's confusing.
    if ($page->id != $result->newpageid) {
        // Button to continue the lesson (the page to go is configured by the teacher).
        echo $OUTPUT->single_button($url, get_string('reviewquestioncontinue', 'lesson'));
    }
} else {
    // Normal continue button
    echo $OUTPUT->single_button($url, get_string('continue', 'lesson'));
}

echo $lessonoutput->footer();