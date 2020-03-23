<?php
//

/**
 * This script triggers a full purging of system caches,
 * this is useful mostly for developers who did not disable the caching.
 *
 * @package    core
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');

$confirm = optional_param('confirm', 0, PARAM_BOOL);
$returnurl = optional_param('returnurl', '/admin/purgecaches.php', PARAM_LOCALURL);
$returnurl = new moodle_url($returnurl);

admin_externalpage_setup('purgecaches');

$form = new core_admin\form\purge_caches(null, ['returnurl' => $returnurl]);

// If we have got here as a confirmed aciton, do it.
if ($data = $form->get_data()) {

    // Valid request. Purge, and redirect the user back to where they came from.
    $selected = $data->purgeselectedoptions;
    purge_caches($selected);

    if (isset($data->all)) {
        $message = get_string('purgecachesfinished', 'admin');
    } else {
        $message = get_string('purgeselectedcachesfinished', 'admin');
    }

} else if ($confirm && confirm_sesskey()) {
    purge_caches();
    $message = get_string('purgecachesfinished', 'admin');
}

if (isset($message)) {
    redirect($returnurl, $message);
}

// Otherwise, show a form to actually purge the caches.

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('purgecachespage', 'admin'));

echo $OUTPUT->box_start('generalbox', 'notice');
echo html_writer::tag('p', get_string('purgecachesconfirm', 'admin'));
echo $form->render();
echo $OUTPUT->box_end();

echo $OUTPUT->footer();
