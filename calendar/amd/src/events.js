//

/**
 * Contain the events the calendar component can fire.
 *
 * @module     core_calendar/events
 * @class      calendar_events
 * @package    core_calendar
 * @copyright  2017 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([], function() {
    return {
        created: 'calendar-events:created',
        deleted: 'calendar-events:deleted',
        deleteAll: 'calendar-events:delete_all',
        updated: 'calendar-events:updated',
        editEvent: 'calendar-events:edit_event',
        editActionEvent: 'calendar-events:edit_action_event',
        eventMoved: 'calendar-events:event_moved',
        dayChanged: 'calendar-events:day_changed',
        monthChanged: 'calendar-events:month_changed',
        moveEvent: 'calendar-events:move_event',
        filterChanged: 'calendar-events:filter_changed',
        viewUpdated: 'calendar-events:view_updated',
    };
});
