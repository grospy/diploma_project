//

/**
 * Module to navigation between users in a course.
 *
 * @package    report_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery'], function($) {

    /**
     * UserCourseNavigation
     *
     * @param {String} userSelector The selector of the user element.
     * @param {String} moduleSelector The selector of the module element.
     * @param {String} baseUrl The base url for the page (no params).
     * @param {Number} userId The course id
     * @param {Number} courseId The user id
     * @param {Number} moduleId The activity module (filter)
     */
    var UserCourseNavigation = function(userSelector, moduleSelector, baseUrl, userId, courseId, moduleId) {
        this._baseUrl = baseUrl;
        this._userId = userId + '';
        this._courseId = courseId;
        this._moduleId = moduleId;

        $(userSelector).on('change', this._userChanged.bind(this));
        $(moduleSelector).on('change', this._moduleChanged.bind(this));
    };

    /**
     * The user was changed in the select list.
     *
     * @method _userChanged
     * @param {Event} e the event
     */
    UserCourseNavigation.prototype._userChanged = function(e) {
        var newUserId = $(e.target).val();
        var queryStr = '?user=' + newUserId + '&id=' + this._courseId + '&mod=' + this._moduleId;
        document.location = this._baseUrl + queryStr;
    };

    /**
     * The module was changed in the select list.
     *
     * @method _moduleChanged
     * @param {Event} e the event
     */
    UserCourseNavigation.prototype._moduleChanged = function(e) {
        var newModuleId = $(e.target).val();
        var queryStr = '?mod=' + newModuleId + '&id=' + this._courseId + '&user=' + this._userId;
        document.location = this._baseUrl + queryStr;
    };

    /** @type {Number} The id of the user. */
    UserCourseNavigation.prototype._userId = null;
    /** @type {Number} The id of the module. */
    UserCourseNavigation.prototype._moduleId = null;
    /** @type {Number} The id of the course. */
    UserCourseNavigation.prototype._courseId = null;
    /** @type {String} Plugin base url. */
    UserCourseNavigation.prototype._baseUrl = null;

    return /** @alias module:report_competency/user_course_navigation */ UserCourseNavigation;

});
