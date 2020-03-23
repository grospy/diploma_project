<?php
//

/**
 * View user acceptances to the policies
 *
 * @package     tool_policy
 * @copyright   2018 Marina Glancy
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../../config.php');
require_once($CFG->dirroot.'/user/editlib.php');

$userid = optional_param('userid', null, PARAM_INT);
$returnurl = optional_param('returnurl', null, PARAM_LOCALURL);

require_login();
$userid = $userid ?: $USER->id;
if (isguestuser() || isguestuser($userid)) {
    print_error('noguest');
}
$context = context_user::instance($userid);
if ($userid != $USER->id) {
    // Check capability to view acceptances. No capability is needed to view your own acceptances.
    if (!has_capability('tool/policy:acceptbehalf', $context)) {
        require_capability('tool/policy:viewacceptances', $context);
    }

    $user = core_user::get_user($userid);
    $PAGE->navigation->extend_for_user($user);
}

$title = get_string('policiesagreements', 'tool_policy');

$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url(new moodle_url('/admin/tool/policy/user.php', ['userid' => $userid]));
$PAGE->set_title($title);

if ($userid == $USER->id &&
        ($profilenode = $PAGE->settingsnav->find('myprofile', null))) {

    $profilenode->make_active();
}

$PAGE->navbar->add($title);

$output = $PAGE->get_renderer('tool_policy');
echo $output->header();
echo $output->heading($title);
$acceptances = new \tool_policy\output\acceptances($userid, $returnurl);
echo $output->render($acceptances);
$PAGE->requires->js_call_amd('tool_policy/acceptmodal', 'getInstance', [context_system::instance()->id]);
echo $output->footer();
