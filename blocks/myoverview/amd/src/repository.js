//

/**
 * A javascript module to retrieve enrolled coruses from the server.
 *
 * @package    block_myoverview
 * @copyright  2018 Bas Brands <base@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/ajax', 'core/notification'], function(Ajax, Notification) {

    /**
     * Retrieve a list of enrolled courses.
     *
     * Valid args are:
     * string classification    future, inprogress, past
     * int limit                number of records to retreive
     * int Offset               offset for pagination
     * int sort                 sort by lastaccess or name
     *
     * @method getEnrolledCoursesByTimeline
     * @param {object} args The request arguments
     * @return {promise} Resolved with an array of courses
     */
    var getEnrolledCoursesByTimeline = function(args) {

        var request = {
            methodname: 'core_course_get_enrolled_courses_by_timeline_classification',
            args: args
        };

        var promise = Ajax.call([request])[0];

        return promise;
    };

    /**
     * Set the favourite state on a list of courses.
     *
     * Valid args are:
     * Array courses  list of course id numbers.
     *
     * @param {Object} args Arguments send to the webservice.
     * @return {Promise} Resolve with warnings.
     */
    var setFavouriteCourses = function(args) {

        var request = {
            methodname: 'core_course_set_favourite_courses',
            args: args
        };

        var promise = Ajax.call([request])[0];

        return promise;
    };

    /**
     * Update the user preferences.
     *
     * @param {Object} args Arguments send to the webservice.
     *
     * Sample args:
     * {
     *     preferences: [
     *         {
     *             type: 'block_example_user_sort_preference'
     *             value: 'title'
     *         }
     *     ]
     * }
     */
    var updateUserPreferences = function(args) {
        var request = {
            methodname: 'core_user_update_user_preferences',
            args: args
        };

        Ajax.call([request])[0]
            .fail(Notification.exception);
    };

    return {
        getEnrolledCoursesByTimeline: getEnrolledCoursesByTimeline,
        setFavouriteCourses: setFavouriteCourses,
        updateUserPreferences: updateUserPreferences
    };
});