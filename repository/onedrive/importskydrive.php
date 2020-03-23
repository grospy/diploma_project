<?php
//

/**
 * Import files from skydrive.
 *
 * @package    repository_onedrive
 * @copyright  2017 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');

$PAGE->set_url('/repository/onedrive/importskydrive.php');
$PAGE->set_context(context_system::instance());
$strheading = get_string('importskydrivefiles', 'repository_onedrive');
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

require_login();

require_capability('moodle/site:config', context_system::instance());

$confirm = optional_param('confirm', false, PARAM_BOOL);

if ($confirm) {
    require_sesskey();
    require_once($CFG->dirroot . '/repository/lib.php');
    require_once($CFG->dirroot . '/repository/onedrive/lib.php');

    if (repository_onedrive::import_skydrive_files()) {
        $mesg = get_string('skydrivefilesimported', 'repository_onedrive');
        redirect(new moodle_url('/admin/repository.php'), $mesg, null, \core\output\notification::NOTIFY_SUCCESS);
    } else {
        $mesg = get_string('skydrivefilesnotimported', 'repository_onedrive');
        redirect(new moodle_url('/admin/repository.php'), $mesg, null, \core\output\notification::NOTIFY_ERROR);
    }
} else {
    $continueurl = new moodle_url('/repository/onedrive/importskydrive.php', ['confirm' => true]);
    $cancelurl = new moodle_url('/admin/repository.php');
    echo $OUTPUT->header();
    echo $OUTPUT->confirm(get_string('confirmimportskydrive', 'repository_onedrive'), $continueurl, $cancelurl);
    echo $OUTPUT->footer();
}
