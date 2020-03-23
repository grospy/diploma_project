<?php
//

/**
 * This page receives ajax rating submissions
 *
 * It is similar to rate.php. Unlike rate.php a return url is NOT required.
 *
 * @package    core_rating
 * @category   rating
 * @copyright  2010 Andrew Davis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);

require_once('../config.php');
require_once($CFG->dirroot.'/rating/lib.php');

$contextid         = required_param('contextid', PARAM_INT);
$component         = required_param('component', PARAM_COMPONENT);
$ratingarea        = required_param('ratingarea', PARAM_AREA);
$itemid            = required_param('itemid', PARAM_INT);
$scaleid           = required_param('scaleid', PARAM_INT);
$userrating        = required_param('rating', PARAM_INT);
$rateduserid       = required_param('rateduserid', PARAM_INT); // The user being rated. Required to update their grade.
$aggregationmethod = optional_param('aggregation', RATING_AGGREGATE_NONE, PARAM_INT); // Used to calculate the aggregate to return.

$result = new stdClass;

// If session has expired and its an ajax request so we cant do a page redirect.
if (!isloggedin()) {
    $result->error = get_string('sessionerroruser', 'error');
    echo json_encode($result);
    die();
}

list($context, $course, $cm) = get_context_info_array($contextid);
require_login($course, false, $cm);

$contextid = null; // Now we have a context object, throw away the id from the user.
$PAGE->set_context($context);
$PAGE->set_url('/rating/rate_ajax.php', array('contextid' => $context->id));

if (!confirm_sesskey() || !has_capability('moodle/rating:rate', $context)) {
    echo $OUTPUT->header();
    echo get_string('ratepermissiondenied', 'rating');
    echo $OUTPUT->footer();
    die();
}

$rm = new rating_manager();
$result = $rm->add_rating($cm, $context, $component, $ratingarea, $itemid, $scaleid, $userrating, $rateduserid, $aggregationmethod);

// Return translated error.
if (!empty($result->error)) {
    $result->error = get_string($result->error, 'rating');
}

echo json_encode($result);
