<?php
//

/**
 * This file is used to display a categories sub categories, external pages, and settings.
 *
 * @package    admin
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../config.php');
require_once("{$CFG->libdir}/adminlib.php");

$contextid = required_param('id', PARAM_INT);
$confirm = optional_param('confirm', null, PARAM_INT);
$returnurl = optional_param('returnurl', null, PARAM_LOCALURL);

$PAGE->set_url('/admin/lock.php', ['id' => $contextid]);

list($context, $course, $cm) = get_context_info_array($contextid);

$parentcontext = $context->get_parent_context();
if ($parentcontext && !empty($parentcontext->locked)) {
    // Can't make changes to a context whose parent is locked.
    throw new \coding_exception('Not sure how you got here');
}

if ($course) {
    $isfrontpage = ($course->id == SITEID);
} else {
    $isfrontpage = false;
    $course = $SITE;
}

require_login($course, false, $cm);
require_capability('moodle/site:managecontextlocks', $context);

$PAGE->set_pagelayout('admin');
$PAGE->navigation->clear_cache();

$a = (object) [
    'contextname' => $context->get_context_name(),
];

if (null !== $confirm && confirm_sesskey()) {
    $context->set_locked(!empty($confirm));

    if ($context->locked) {
        $lockmessage = get_string('managecontextlocklocked', 'admin', $a);
    } else {
        $lockmessage = get_string('managecontextlockunlocked', 'admin', $a);
    }

    if (empty($returnurl)) {
        $returnurl = $context->get_url();
    } else {
        $returnurl = new moodle_url($returnurl);
    }
    redirect($returnurl, $lockmessage);
}

$heading = get_string('managecontextlock', 'admin');
$PAGE->set_title($heading);
$PAGE->set_heading($heading);

echo $OUTPUT->header();

if ($context->locked) {
    $confirmstring = get_string('confirmcontextunlock', 'admin', $a);
    $target = 0;
} else {
    $confirmstring = get_string('confirmcontextlock', 'admin', $a);
    $target = 1;
}

$confirmurl = new \moodle_url($PAGE->url, ['confirm' => $target]);
if (!empty($returnurl)) {
    $confirmurl->param('returnurl', $returnurl);
}

echo $OUTPUT->confirm($confirmstring, $confirmurl, $context->get_url());
echo $OUTPUT->footer();
