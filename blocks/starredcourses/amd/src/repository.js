//

/**
 * A javascript module to retrieve user's starred courses.
 *
 * @package    block_starredcourses
 * @copyright  2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/ajax', 'core/notification'], function($, Ajax, Notification) {

    /**
     * Retrieve a list of starred courses.
     *
     * Valid args are:
     * int limit    number of records to retrieve
     * int offset   the offset of records to retrieve
     *
     * @method getStarredCourses
     * @param {object} args The request arguments
     * @return {promise} Resolved with an array of courses
     */
    var getStarredCourses = function(args) {

        var request = {
            methodname: 'block_starredcourses_get_starred_courses',
            args: args
        };

        var promise = Ajax.call([request])[0];

        promise.fail(Notification.exception);

        return promise;
    };

    return {
        getStarredCourses: getStarredCourses
    };
});