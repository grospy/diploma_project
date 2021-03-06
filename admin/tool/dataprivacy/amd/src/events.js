//

/**
 * Contain the events the data privacy tool can fire.
 *
 * @module     tool_dataprivacy/events
 * @class      events
 * @package    tool_dataprivacy
 * @copyright  2018 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([], function() {
    return {
        approve: 'tool_dataprivacy-data_request:approve',
        bulkApprove: 'tool_dataprivacy-data_request:bulk_approve',
        deny: 'tool_dataprivacy-data_request:deny',
        bulkDeny: 'tool_dataprivacy-data_request:bulk_deny',
        complete: 'tool_dataprivacy-data_request:complete'
    };
});
