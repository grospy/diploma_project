<?php
//

/**
 * Displays available badges to a user
 *
 * @package    core
 * @subpackage badges
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */

require_once(__DIR__ . '/../config.php');
require_once($CFG->libdir . '/badgeslib.php');

$type       = required_param('type', PARAM_INT);
$courseid   = optional_param('id', 0, PARAM_INT);
$sortby     = optional_param('sort', 'name', PARAM_ALPHA);
$sorthow    = optional_param('dir', 'DESC', PARAM_ALPHA);
$page       = optional_param('page', 0, PARAM_INT);

require_login();

if (empty($CFG->enablebadges)) {
    print_error('badgesdisabled', 'badges');
}

if (empty($CFG->badges_allowcoursebadges) && $courseid != 0) {
    print_error('coursebadgesdisabled', 'badges');
}

if (!in_array($sortby, array('name', 'dateissued'))) {
    $sortby = 'name';
}

if ($sorthow != 'ASC' && $sorthow != 'DESC') {
    $sorthow = 'ASC';
}

if ($page < 0) {
    $page = 0;
}

if ($course = $DB->get_record('course', array('id' => $courseid))) {
    $PAGE->set_url('/badges/view.php', array('type' => $type, 'id' => $course->id, 'sort' => $sortby, 'dir' => $sorthow));
} else {
    $PAGE->set_url('/badges/view.php', array('type' => $type, 'sort' => $sortby, 'dir' => $sorthow));
}

if ($type == BADGE_TYPE_SITE) {
    $PAGE->set_context(context_system::instance());
    $PAGE->set_pagelayout('admin');
    $PAGE->set_heading($SITE->fullname);
    $title = get_string('sitebadges', 'badges');
    $eventotherparams = array('badgetype' => BADGE_TYPE_SITE);
} else {
    require_login($course);
    $coursename = format_string($course->fullname, true, array('context' => context_course::instance($course->id)));
    $title = $coursename . ': ' . get_string('coursebadges', 'badges');
    $PAGE->set_context(context_course::instance($course->id));
    $PAGE->set_pagelayout('incourse');
    $PAGE->set_heading($coursename);
    $eventotherparams = array('badgetype' => BADGE_TYPE_COURSE, 'courseid' => $course->id);
}

require_capability('moodle/badges:viewbadges', $PAGE->context);

$PAGE->set_title($title);
$output = $PAGE->get_renderer('core', 'badges');

echo $output->header();
echo $OUTPUT->heading($title);

$totalcount = count(badges_get_badges($type, $courseid, '', '', 0, 0, $USER->id));
$records = badges_get_badges($type, $courseid, $sortby, $sorthow, $page, BADGE_PERPAGE, $USER->id);

if ($totalcount) {
    echo $output->heading(get_string('badgestoearn', 'badges', $totalcount), 4);

    if ($course && $course->startdate > time()) {
        echo $OUTPUT->box(get_string('error:notifycoursedate', 'badges'), 'generalbox notifyproblem');
    }

    $badges             = new \core_badges\output\badge_collection($records);
    $badges->sort       = $sortby;
    $badges->dir        = $sorthow;
    $badges->page       = $page;
    $badges->perpage    = BADGE_PERPAGE;
    $badges->totalcount = $totalcount;

    echo $output->render($badges);
} else {
    echo $output->notification(get_string('nobadges', 'badges'));
}

// Display "Manage badges" button to users with proper capabilities.
$isfrontpage = (empty($courseid) || $courseid == $SITE->id);
if ($isfrontpage) {
    $context = context_system::instance();
} else {
    $context = context_course::instance($courseid);
}
$canmanage = has_any_capability(array('moodle/badges:viewawarded',
                                      'moodle/badges:createbadge',
                                      'moodle/badges:awardbadge',
                                      'moodle/badges:configurecriteria',
                                      'moodle/badges:configuremessages',
                                      'moodle/badges:configuredetails',
                                      'moodle/badges:deletebadge'), $context);
if ($canmanage) {
    echo $output->single_button(new moodle_url('/badges/index.php', array('type' => $type, 'id' => $courseid)),
        get_string('managebadges', 'badges'));
}

// Display "Add new badge" button to users with capability to create badges.
if (has_capability('moodle/badges:createbadge', $PAGE->context)) {
    echo $output->single_button(new moodle_url('newbadge.php', array('type' => $type, 'id' => $courseid)),
        get_string('newbadge', 'badges'));
}

// Trigger event, badge listing viewed.
$eventparams = array('context' => $PAGE->context, 'other' => $eventotherparams);
$event = \core\event\badge_listing_viewed::create($eventparams);
$event->trigger();

echo $output->footer();