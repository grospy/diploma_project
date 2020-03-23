<?php
//

/**
 * Display the request reject + resubmit confirmation page.
 *
 * @copyright 2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package tool_dataprivacy
 */

require_once('../../../config.php');

$requestid = required_param('requestid', PARAM_INT);
$confirm = optional_param('confirm', null, PARAM_INT);

$url = new moodle_url('/admin/tool/dataprivacy/resubmitrequest.php', ['requestid' => $requestid]);
$title = get_string('resubmitrequestasnew', 'tool_dataprivacy');

\tool_dataprivacy\page_helper::setup($url, $title, 'datarequests', 'tool/dataprivacy:managedatarequests');

$manageurl = new moodle_url('/admin/tool/dataprivacy/datarequests.php');

$originalrequest = \tool_dataprivacy\api::get_request($requestid);
$user = \core_user::get_user($originalrequest->get('userid'));
$stringparams = (object) [
        'username' => fullname($user),
        'type' => \tool_dataprivacy\local\helper::get_shortened_request_type_string($originalrequest->get('type')),
    ];

if (null !== $confirm && confirm_sesskey()) {
    if ($originalrequest->get('type') == \tool_dataprivacy\api::DATAREQUEST_TYPE_DELETE
        && !\tool_dataprivacy\api::can_create_data_deletion_request_for_other()) {
        throw new required_capability_exception(context_system::instance(),
            'tool/dataprivacy:requestdeleteforotheruser', 'nopermissions', '');
    }
    $originalrequest->resubmit_request();
    redirect($manageurl, get_string('resubmittedrequest', 'tool_dataprivacy', $stringparams));
}

echo $OUTPUT->header();

$confirmstring = get_string('confirmrequestresubmit', 'tool_dataprivacy', $stringparams);
$confirmurl = new \moodle_url($PAGE->url, ['confirm' => 1]);
echo $OUTPUT->confirm($confirmstring, $confirmurl, $manageurl);
echo $OUTPUT->footer();
