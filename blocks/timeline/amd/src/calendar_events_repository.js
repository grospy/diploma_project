//

/**
 * A javascript module to retrieve calendar events from the server.
 *
 * @module     block_timeline/calendar_events_repository
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/ajax', 'core/notification'], function($, Ajax, Notification) {

    var DEFAULT_LIMIT = 20;

    /**
     * Retrieve a list of calendar events for the logged in user for the
     * given course.
     *
     * Valid args are:
     * int courseid     Only get events for this course
     * int starttime    Only get events after this time
     * int endtime      Only get events before this time
     * int limit        Limit the number of results returned
     * int aftereventid Offset the result set from the given id
     *
     * @method queryByCourse
     * @param {object} args The request arguments
     * @return {promise} Resolved with an array of the calendar events
     */
    var queryByCourse = function(args) {
        if (!args.hasOwnProperty('limit')) {
            args.limit = DEFAULT_LIMIT;
        }

        args.limitnum = args.limit;
        delete args.limit;

        if (args.hasOwnProperty('starttime')) {
            args.timesortfrom = args.starttime;
            delete args.starttime;
        }

        if (args.hasOwnProperty('endtime')) {
            args.timesortto = args.endtime;
            delete args.endtime;
        }

        var request = {
            methodname: 'core_calendar_get_action_events_by_course',
            args: args
        };

        var promise = Ajax.call([request])[0];

        promise.fail(Notification.exception);

        return promise;
    };

    /**
     * Retrieve a list of calendar events for the given courses for the
     * logged in user.
     *
     * Valid args are:
     * array courseids    Get events for these courses
     * int   starttime    Only get events after this time
     * int   endtime      Only get events before this time
     * int   limit        Limit the number of results returned
     *
     * @method queryByCourses
     * @param {object} args The request arguments
     * @return {promise} Resolved with an array of the calendar events
     */
    var queryByCourses = function(args) {
        if (!args.hasOwnProperty('limit')) {
            // This is intentionally smaller than the default limit.
            args.limit = 10;
        }

        args.limitnum = args.limit;
        delete args.limit;

        if (args.hasOwnProperty('starttime')) {
            args.timesortfrom = args.starttime;
            delete args.starttime;
        }

        if (args.hasOwnProperty('endtime')) {
            args.timesortto = args.endtime;
            delete args.endtime;
        }

        var request = {
            methodname: 'core_calendar_get_action_events_by_courses',
            args: args
        };

        var promise = Ajax.call([request])[0];

        promise.fail(Notification.exception);

        return promise;
    };

    /**
     * Retrieve a list of calendar events for the logged in user after the given
     * time.
     *
     * Valid args are:
     * int starttime    Only get events after this time
     * int endtime      Only get events before this time
     * int limit        Limit the number of results returned
     * int aftereventid Offset the result set from the given id
     *
     * @method queryByTime
     * @param {object} args The request arguments
     * @return {promise} Resolved with an array of the calendar events
     */
    var queryByTime = function(args) {
        if (!args.hasOwnProperty('limit')) {
            args.limit = DEFAULT_LIMIT;
        }

        args.limitnum = args.limit;
        delete args.limit;

        if (args.hasOwnProperty('starttime')) {
            args.timesortfrom = args.starttime;
            delete args.starttime;
        }

        if (args.hasOwnProperty('endtime')) {
            args.timesortto = args.endtime;
            delete args.endtime;
        }
        // Don't show events related to courses that the user is suspended in.
        args.limittononsuspendedevents = true;

        var request = {
            methodname: 'core_calendar_get_action_events_by_timesort',
            args: args
        };

        var promise = Ajax.call([request])[0];

        promise.fail(Notification.exception);

        return promise;
    };

    return {
        queryByTime: queryByTime,
        queryByCourse: queryByCourse,
        queryByCourses: queryByCourses,
    };
});
