<?php
//

/**
 * Accept or revoke policies on behalf of users (non-JS version)
 *
 * @package     tool_policy
 * @copyright   2018 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../../config.php');
require_once($CFG->dirroot.'/user/editlib.php');

$userids = optional_param_array('userids', null, PARAM_INT);
$versionids = optional_param_array('versionids', null, PARAM_INT);
$returnurl = optional_param('returnurl', null, PARAM_LOCALURL);
$action = optional_param('action', null, PARAM_ALPHA);

require_login();
if (isguestuser()) {
    print_error('noguest');
}
$context = context_system::instance();

$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/admin/tool/policy/accept.php'));

if (!in_array($action, ['accept', 'decline', 'revoke'])) {
    throw new moodle_exception('invalidaccessparameter');
}

if ($returnurl) {
    $returnurl = new moodle_url($returnurl);
} else if (count($userids) == 1) {
    $userid = reset($userids);
    $returnurl = new moodle_url('/admin/tool/policy/user.php', ['userid' => $userid]);
} else {
    $returnurl = new moodle_url('/admin/tool/policy/acceptances.php');
}
// Initialise the form, this will also validate users, versions and check permission to accept policies.
$form = new \tool_policy\form\accept_policy(null,
    ['versionids' => $versionids, 'userids' => $userids, 'showbuttons' => true, 'action' => $action]);
$form->set_data(['returnurl' => $returnurl]);

if ($form->is_cancelled()) {
    redirect($returnurl);
} else if ($form->get_data()) {
    $form->process();
    redirect($returnurl);
}

$output = $PAGE->get_renderer('tool_policy');
echo $output->header();
echo $output->heading(get_string('statusformtitle'.$action, 'tool_policy'));
$form->display();
echo $output->footer();
