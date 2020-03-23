//

/**
 * A javascript module to handle course ajax actions.
 *
 * @module     core_course/repository
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/ajax'], function($, Ajax) {

    /**
     * Get the list of courses that the logged in user is enrolled in for a given
     * timeline classification.
     *
     * @param {string} classification past, inprogress, or future
     * @param {int} limit Only return this many results
     * @param {int} offset Skip this many results from the start of the result set
     * @param {string} sort Column to sort by and direction, e.g. 'shortname asc'
     * @return {object} jQuery promise resolved with courses.
     */
    var getEnrolledCoursesByTimelineClassification = function(classification, limit, offset, sort) {
        var args = {
            classification: classification
        };

        if (typeof limit !== 'undefined') {
            args.limit = limit;
        }

        if (typeof offset !== 'undefined') {
            args.offset = offset;
        }

        if (typeof sort !== 'undefined') {
            args.sort = sort;
        }

        var request = {
            methodname: 'core_course_get_enrolled_courses_by_timeline_classification',
            args: args
        };

        return Ajax.call([request])[0];
    };

    /**
     * Get the list of courses that the user has most recently accessed.
     *
     * @method getLastAccessedCourses
     * @param {int} userid User from which the courses will be obtained
     * @param {int} limit Only return this many results
     * @param {int} offset Skip this many results from the start of the result set
     * @param {string} sort Column to sort by and direction, e.g. 'shortname asc'
     * @return {promise} Resolved with an array of courses
     */
    var getLastAccessedCourses = function(userid, limit, offset, sort) {
        var args = {};

        if (typeof userid !== 'undefined') {
            args.userid = userid;
        }

        if (typeof limit !== 'undefined') {
            args.limit = limit;
        }

        if (typeof offset !== 'undefined') {
            args.offset = offset;
        }

        if (typeof sort !== 'undefined') {
            args.sort = sort;
        }

        var request = {
            methodname: 'core_course_get_recent_courses',
            args: args
        };

        return Ajax.call([request])[0];
    };

    /**
     * Get the list of users enrolled in this cmid.
     *
     * @param {Number} cmid Course Module from which the users will be obtained
     * @param {Number} groupID Group ID from which the users will be obtained
     * @returns {Promise} Promise containing a list of users
     */
    var getEnrolledUsersFromCourseModuleID = function(cmid, groupID) {
        var request = {
            methodname: 'core_course_get_enrolled_users_by_cmid',
            args: {
                cmid: cmid,
                groupid: groupID,
            },
        };

        return Ajax.call([request])[0];
    };

    return {
        getEnrolledCoursesByTimelineClassification: getEnrolledCoursesByTimelineClassification,
        getLastAccessedCourses: getLastAccessedCourses,
        getUsersFromCourseModuleID: getEnrolledUsersFromCourseModuleID,
    };
});
