<?php
//

/**
 * Script for importing questions into the question bank.
 *
 * @package    moodlecore
 * @subpackage questionbank
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../config.php');
require_once($CFG->dirroot . '/question/editlib.php');
require_once($CFG->dirroot . '/question/export_form.php');
require_once($CFG->dirroot . '/question/format.php');

list($thispageurl, $contexts, $cmid, $cm, $module, $pagevars) =
        question_edit_setup('export', '/question/export.php');

// get display strings
$strexportquestions = get_string('exportquestions', 'question');

list($catid, $catcontext) = explode(',', $pagevars['cat']);
$category = $DB->get_record('question_categories', array("id" => $catid, 'contextid' => $catcontext), '*', MUST_EXIST);

/// Header
$PAGE->set_url($thispageurl);
$PAGE->set_title($strexportquestions);
$PAGE->set_heading($COURSE->fullname);
echo $OUTPUT->header();

// Print horizontal nav if needed.
$renderer = $PAGE->get_renderer('core_question', 'bank');
echo $renderer->extra_horizontal_navigation();

$export_form = new question_export_form($thispageurl,
        array('contexts' => $contexts->having_one_edit_tab_cap('export'), 'defaultcategory' => $pagevars['cat']));


if ($from_form = $export_form->get_data()) {
    $thiscontext = $contexts->lowest();
    if (!is_readable("format/{$from_form->format}/format.php")) {
        print_error('unknowformat', '', '', $from_form->format);
    }
    $withcategories = 'nocategories';
    if (!empty($from_form->cattofile)) {
        $withcategories = 'withcategories';
    }
    $withcontexts = 'nocontexts';
    if (!empty($from_form->contexttofile)) {
        $withcontexts = 'withcontexts';
    }

    $classname = 'qformat_' . $from_form->format;
    $qformat = new $classname();
    $filename = question_default_export_filename($COURSE, $category) .
            $qformat->export_file_extension();
    $export_url = question_make_export_url($thiscontext->id, $category->id,
            $from_form->format, $withcategories, $withcontexts, $filename);

    echo $OUTPUT->box_start();
    echo get_string('yourfileshoulddownload', 'question', $export_url->out());
    echo $OUTPUT->box_end();

    // Log the export of these questions.
    $eventparams = [
            'contextid' => $category->contextid,
            'other' => ['format' => $from_form->format, 'categoryid' => $category->id],
    ];
    $event = \core\event\questions_exported::create($eventparams);
    $event->trigger();

    // Don't allow force download for behat site, as pop-up can't be handled by selenium.
    if (!defined('BEHAT_SITE_RUNNING')) {
        $PAGE->requires->js_function_call('document.location.replace', array($export_url->out(false)), false, 1);
    }

    echo $OUTPUT->continue_button(new moodle_url('edit.php', $thispageurl->params()));
    echo $OUTPUT->footer();
    exit;
}

/// Display export form
echo $OUTPUT->heading_with_help($strexportquestions, 'exportquestions', 'question');

$export_form->display();

echo $OUTPUT->footer();
