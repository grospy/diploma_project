<?php
//

/**
 * Class containing data for a user's data requests.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_dataprivacy\output;
defined('MOODLE_INTERNAL') || die();

use action_menu;
use action_menu_link_secondary;
use coding_exception;
use context_user;
use moodle_exception;
use moodle_url;
use renderable;
use renderer_base;
use stdClass;
use templatable;
use tool_dataprivacy\api;
use tool_dataprivacy\data_request;
use tool_dataprivacy\external\data_request_exporter;

/**
 * Class containing data for a user's data requests.
 *
 * @copyright  2018 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class my_data_requests_page implements renderable, templatable {

    /** @var array $requests List of data requests. */
    protected $requests = [];

    /**
     * Construct this renderable.
     *
     * @param data_request[] $requests
     */
    public function __construct($requests) {
        $this->requests = $requests;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     * @throws coding_exception
     * @throws moodle_exception
     */
    public function export_for_template(renderer_base $output) {
        global $USER;

        $data = new stdClass();
        $data->newdatarequesturl = new moodle_url('/admin/tool/dataprivacy/createdatarequest.php');

        if (!is_https()) {
            $httpwarningmessage = get_string('httpwarning', 'tool_dataprivacy');
            $data->httpsite = array('message' => $httpwarningmessage, 'announce' => 1);
        }

        $requests = [];
        foreach ($this->requests as $request) {
            $requestid = $request->get('id');
            $status = $request->get('status');
            $userid = $request->get('userid');
            $type = $request->get('type');

            $usercontext = context_user::instance($userid, IGNORE_MISSING);
            if (!$usercontext) {
                // Use the context system.
                $outputcontext = \context_system::instance();
            } else {
                $outputcontext = $usercontext;
            }

            $requestexporter = new data_request_exporter($request, ['context' => $outputcontext]);
            $item = $requestexporter->export($output);

            $self = $request->get('userid') == $USER->id;
            if (!$self) {
                // Append user name if it differs from $USER.
                $a = (object)['typename' => $item->typename, 'user' => $item->foruser->fullname];
                $item->typename = get_string('requesttypeuser', 'tool_dataprivacy', $a);
            }

            $candownload = false;
            $cancancel = true;
            switch ($status) {
                case api::DATAREQUEST_STATUS_COMPLETE:
                    $item->statuslabelclass = 'badge-success';
                    $item->statuslabel = get_string('statuscomplete', 'tool_dataprivacy');
                    $cancancel = false;
                    break;
                case api::DATAREQUEST_STATUS_DOWNLOAD_READY:
                    $item->statuslabelclass = 'badge-success';
                    $item->statuslabel = get_string('statusready', 'tool_dataprivacy');
                    $cancancel = false;
                    $candownload = true;

                    if ($usercontext) {
                        $candownload = api::can_download_data_request_for_user(
                                $request->get('userid'), $request->get('requestedby'));
                    }
                    break;
                case api::DATAREQUEST_STATUS_DELETED:
                    $item->statuslabelclass = 'badge-success';
                    $item->statuslabel = get_string('statusdeleted', 'tool_dataprivacy');
                    $cancancel = false;
                    break;
                case api::DATAREQUEST_STATUS_EXPIRED:
                    $item->statuslabelclass = 'badge-secondary';
                    $item->statuslabel = get_string('statusexpired', 'tool_dataprivacy');
                    $item->statuslabeltitle = get_string('downloadexpireduser', 'tool_dataprivacy');
                    $cancancel = false;
                    break;
                case api::DATAREQUEST_STATUS_CANCELLED:
                case api::DATAREQUEST_STATUS_REJECTED:
                    $cancancel = false;
                    break;
            }

            // Prepare actions.
            $actions = [];
            if ($cancancel) {
                $cancelurl = new moodle_url('#');
                $canceldata = ['data-action' => 'cancel', 'data-requestid' => $requestid];
                $canceltext = get_string('cancelrequest', 'tool_dataprivacy');
                $actions[] = new action_menu_link_secondary($cancelurl, null, $canceltext, $canceldata);
            }
            if ($candownload && $usercontext) {
                $actions[] = api::get_download_link($usercontext, $requestid);
            }
            if (!empty($actions)) {
                $actionsmenu = new action_menu($actions);
                $actionsmenu->set_menu_trigger(get_string('actions'));
                $actionsmenu->set_owner_selector('request-actions-' . $requestid);
                $actionsmenu->set_alignment(\action_menu::TL, \action_menu::BL);
                $item->actions = $actionsmenu->export_for_template($output);
            }

            $requests[] = $item;
        }
        $data->requests = $requests;
        return $data;
    }
}