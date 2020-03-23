<?php

//

/**
 * This file is responsible for saving the results of a users survey and displaying
 * the final message.
 *
 * @package   mod_survey
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

    require_once('../../config.php');
    require_once('lib.php');


// Make sure this is a legitimate posting

    if (!$formdata = data_submitted() or !confirm_sesskey()) {
        print_error('cannotcallscript');
    }

    $id = required_param('id', PARAM_INT);    // Course Module ID

    if (! $cm = get_coursemodule_from_id('survey', $id)) {
        print_error('invalidcoursemodule');
    }

    if (! $course = $DB->get_record("course", array("id"=>$cm->course))) {
        print_error('coursemisconf');
    }

    $PAGE->set_url('/mod/survey/save.php', array('id'=>$id));
    require_login($course, false, $cm);

    $context = context_module::instance($cm->id);
    require_capability('mod/survey:participate', $context);

    if (! $survey = $DB->get_record("survey", array("id"=>$cm->instance))) {
        print_error('invalidsurveyid', 'survey');
    }

    $strsurveysaved = get_string('surveysaved', 'survey');

    $PAGE->set_title($strsurveysaved);
    $PAGE->set_heading($course->fullname);
    echo $OUTPUT->header();
    echo $OUTPUT->heading(format_string($survey->name));

    if (survey_already_done($survey->id, $USER->id)) {
        notice(get_string("alreadysubmitted", "survey"), get_local_referer(false));
        exit;
    }

    survey_save_answers($survey, $formdata, $course, $context);

// Print the page and finish up.

    notice(get_string("thanksforanswers","survey", $USER->firstname), "$CFG->wwwroot/course/view.php?id=$course->id");

    exit;



