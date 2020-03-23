<?php
//

/**
 * Test that unoconv is configured correctly
 *
 * @package   fileconverter_unoconv
 * @copyright 2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/filelib.php');

$sendpdf = optional_param('sendpdf', 0, PARAM_BOOL);

$PAGE->set_url(new moodle_url('/files/converter/unoconv/testunoconv.php'));
$PAGE->set_context(context_system::instance());

require_login();
require_capability('moodle/site:config', context_system::instance());

$strheading = get_string('test_unoconv', 'fileconverter_unoconv');
$PAGE->navbar->add(get_string('administrationsite'));
$PAGE->navbar->add(get_string('plugins', 'admin'));
$PAGE->navbar->add(get_string('assignmentplugins', 'mod_assign'));
$PAGE->navbar->add(get_string('feedbackplugins', 'mod_assign'));
$PAGE->navbar->add(get_string('pluginname', 'fileconverter_unoconv'),
        new moodle_url('/admin/settings.php', array('section' => 'fileconverterunoconv')));
$PAGE->navbar->add($strheading);
$PAGE->set_heading($strheading);
$PAGE->set_title($strheading);

$converter = new \fileconverter_unoconv\converter();

if ($sendpdf) {
    require_sesskey();

    $converter->serve_test_document();
    die();
}

$result = \fileconverter_unoconv\converter::test_unoconv_path();
switch ($result->status) {
    case \fileconverter_unoconv\converter::UNOCONVPATH_OK:
        $msg = $OUTPUT->notification(get_string('test_unoconvok', 'fileconverter_unoconv'), 'success');
        $pdflink = new moodle_url($PAGE->url, array('sendpdf' => 1, 'sesskey' => sesskey()));
        $msg .= html_writer::link($pdflink, get_string('test_unoconvdownload', 'fileconverter_unoconv'));
        $msg .= html_writer::empty_tag('br');
        break;

    default:
        $msg = $OUTPUT->notification(get_string("test_unoconv{$result->status}", 'fileconverter_unoconv'), 'warning');
        break;
}
$returl = new moodle_url('/admin/settings.php', array('section' => 'fileconverterunoconv'));
$msg .= $OUTPUT->continue_button($returl);

echo $OUTPUT->header();
echo $OUTPUT->box($msg, 'generalbox');
echo $OUTPUT->footer();
