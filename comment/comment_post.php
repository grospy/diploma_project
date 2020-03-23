<?php
//

/*
 * Handling new comments from non-js comments interface
 *
 * @package   core
 * @copyright 2010 Dongsheng Cai {@link http://dongsheng.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once('../config.php');
require_once($CFG->dirroot . '/comment/lib.php');

if (empty($CFG->usecomments)) {
    throw new comment_exception('commentsnotenabled', 'moodle');
}

$contextid = optional_param('contextid', SYSCONTEXTID, PARAM_INT);
list($context, $course, $cm) = get_context_info_array($contextid);

require_login($course, true, $cm);
require_sesskey();

if (!$course) {
    // Require_login() does not set context if called without a $course, do it manually.
    $PAGE->set_context($context);
}

$action    = optional_param('action',    '',  PARAM_ALPHA);
$area      = optional_param('area',      '',  PARAM_AREA);
$content   = optional_param('content',   '',  PARAM_RAW);
$itemid    = optional_param('itemid',    '',  PARAM_INT);
$returnurl = optional_param('returnurl', '/', PARAM_LOCALURL);
$component = optional_param('component', '',  PARAM_COMPONENT);

// Currently this script can only add comments
if ($action !== 'add') {
    redirect($returnurl);
}

$cmt = new stdClass;
$cmt->contextid = $contextid;
if ($course) {
    $cmt->courseid = $course->id;
}
$cmt->cm        = $cm;
$cmt->area      = $area;
$cmt->itemid    = $itemid;
$cmt->component = $component;
$comment = new comment($cmt);

if ($comment->can_post()) {
    $cmt = $comment->add($content);
    if (!empty($cmt) && is_object($cmt)) {
        redirect($returnurl);
    }
}
