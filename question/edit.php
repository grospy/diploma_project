<?php
//

/**
 * Page to edit the question bank
 *
 * @package    moodlecore
 * @subpackage questionbank
 * @copyright  1999 onwards Martin Dougiamas {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../config.php');
require_once($CFG->dirroot . '/question/editlib.php');

list($thispageurl, $contexts, $cmid, $cm, $module, $pagevars) =
        question_edit_setup('questions', '/question/edit.php');

$url = new moodle_url($thispageurl);
if (($lastchanged = optional_param('lastchanged', 0, PARAM_INT)) !== 0) {
    $url->param('lastchanged', $lastchanged);
}
$PAGE->set_url($url);

$questionbank = new core_question\bank\view($contexts, $thispageurl, $COURSE, $cm);
$questionbank->process_actions();

$context = $contexts->lowest();
$streditingquestions = get_string('editquestions', 'question');
$PAGE->set_title($streditingquestions);
$PAGE->set_heading($COURSE->fullname);
echo $OUTPUT->header();

// Print horizontal nav if needed.
$renderer = $PAGE->get_renderer('core_question', 'bank');
echo $renderer->extra_horizontal_navigation();

echo '<div class="questionbankwindow boxwidthwide boxaligncenter">';
$questionbank->display('questions', $pagevars['qpage'], $pagevars['qperpage'],
        $pagevars['cat'], $pagevars['recurse'], $pagevars['showhidden'],
        $pagevars['qbshowtext'], $pagevars['qtagids']);
echo "</div>\n";

// Log the view of this category.
list($categoryid, $contextid) = explode(',', $pagevars['cat']);
$category = new stdClass();
$category->id = $categoryid;
$catcontext = \context::instance_by_id($contextid);
$event = \core\event\question_category_viewed::create_from_question_category_instance($category, $catcontext);
$event->trigger();

echo $OUTPUT->footer();
