<?php
//

/**
 * Event observers supported by this module.
 *
 * @package    tool_dataprivacy
 * @copyright   2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_dataprivacy\event;

use \tool_dataprivacy\api;
use \tool_dataprivacy\data_request;

defined('MOODLE_INTERNAL') || die();

/**
 * Event observers supported by this module.
 *
 * @package    tool_dataprivacy
 * @copyright   2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_deleted_observer {

    /**
     * Create user data deletion request when the user is deleted.
     *
     * @param \core\event\user_deleted $event
     */
    public static function create_delete_data_request(\core\event\user_deleted $event) {
        // Automatic creation of deletion requests must be enabled.
        if (get_config('tool_dataprivacy', 'automaticdeletionrequests')) {
            $requesttypes = [api::DATAREQUEST_TYPE_DELETE];
            $requeststatuses = [api::DATAREQUEST_STATUS_COMPLETE, api::DATAREQUEST_STATUS_DELETED];

            $hasongoingdeleterequests = api::has_ongoing_request($event->objectid, $requesttypes[0]);
            $hascompleteddeleterequest = (api::get_data_requests_count($event->objectid, $requeststatuses,
                    $requesttypes) > 0) ? true : false;

            if (!$hasongoingdeleterequests && !$hascompleteddeleterequest) {
                api::create_data_request($event->objectid, $requesttypes[0],
                        get_string('datarequestcreatedupondelete', 'tool_dataprivacy'),
                        data_request::DATAREQUEST_CREATION_AUTO);
            }
        }
    }
}
