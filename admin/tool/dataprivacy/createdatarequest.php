<?php
//

/**
 * Prints the contact form to the site's Data Protection Officer
 *
 * @copyright 2018 onwards Jun Pataleta
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package tool_dataprivacy
 */

require_once('../../../config.php');
require_once('lib.php');
require_once('createdatarequest_form.php');

$manage = optional_param('manage', 0, PARAM_INT);
$requesttype = optional_param('type', \tool_dataprivacy\api::DATAREQUEST_TYPE_EXPORT, PARAM_INT);

$url = new moodle_url('/admin/tool/dataprivacy/createdatarequest.php', ['manage' => $manage, 'type' => $requesttype]);

$PAGE->set_url($url);

require_login();
if (isguestuser()) {
    print_error('noguest');
}

// Return URL and context.
if ($manage) {
    // For the case where DPO creates data requests on behalf of another user.
    $returnurl = new moodle_url($CFG->wwwroot . '/admin/tool/dataprivacy/datarequests.php');
    $context = context_system::instance();
    // Make sure the user has the proper capability.
    require_capability('tool/dataprivacy:managedatarequests', $context);
    navigation_node::override_active_url($returnurl);
} else {
    // For the case where a user makes request for themselves (or for their children if they are the parent).
    $returnurl = new moodle_url($CFG->wwwroot . '/admin/tool/dataprivacy/mydatarequests.php');
    $context = context_user::instance($USER->id);
}

$PAGE->set_context($context);

if (!$manage && $profilenode = $PAGE->settingsnav->find('myprofile', null)) {
    $profilenode->make_active();
}

$title = get_string('createnewdatarequest', 'tool_dataprivacy');
$PAGE->navbar->add($title);

// If contactdataprotectionofficer is disabled, send the user back to the profile page, or the privacy policy page.
// That is, unless you have sufficient capabilities to perform this on behalf of a user.
if (!$manage && !\tool_dataprivacy\api::can_contact_dpo()) {
    redirect($returnurl, get_string('contactdpoviaprivacypolicy', 'tool_dataprivacy'), 0, \core\output\notification::NOTIFY_ERROR);
}

$mform = new tool_dataprivacy_data_request_form($url->out(false), ['manage' => !empty($manage)]);
$mform->set_data(['type' => $requesttype]);

// Data request cancelled.
if ($mform->is_cancelled()) {
    redirect($returnurl);
}

// Data request submitted.
if ($data = $mform->get_data()) {
    if ($data->userid != $USER->id) {
        if (!\tool_dataprivacy\api::can_manage_data_requests($USER->id)) {
            // If not a DPO, only users with the capability to make data requests for the user should be allowed.
            // (e.g. users with the Parent role, etc).
            \tool_dataprivacy\api::require_can_create_data_request_for_user($data->userid);
        }
    }

    if ($data->type == \tool_dataprivacy\api::DATAREQUEST_TYPE_DELETE) {
        if ($data->userid == $USER->id) {
            if (!\tool_dataprivacy\api::can_create_data_deletion_request_for_self()) {
                throw new moodle_exception('nopermissions', 'error', '',
                    get_string('errorcannotrequestdeleteforself', 'tool_dataprivacy'));
            }
        } else if (!\tool_dataprivacy\api::can_create_data_deletion_request_for_other()
            && !\tool_dataprivacy\api::can_create_data_deletion_request_for_children($data->userid)) {
            throw new moodle_exception('nopermissions', 'error', '',
                get_string('errorcannotrequestdeleteforother', 'tool_dataprivacy'));
        }
    }

    \tool_dataprivacy\api::create_data_request($data->userid, $data->type, $data->comments);

    if ($manage) {
        $foruser = core_user::get_user($data->userid);
        $redirectmessage = get_string('datarequestcreatedforuser', 'tool_dataprivacy', fullname($foruser));
    } else {
        $redirectmessage = get_string('requestsubmitted', 'tool_dataprivacy');
    }
    redirect($returnurl, $redirectmessage);
}

$PAGE->set_heading($SITE->fullname);
$PAGE->set_title($title);
echo $OUTPUT->header();
echo $OUTPUT->heading($title);

echo $OUTPUT->box_start('createrequestform');
$mform->display();
echo $OUTPUT->box_end();

echo $OUTPUT->footer();
