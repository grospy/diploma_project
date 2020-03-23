//

/**
 * Module to navigation between users in a course.
 *
 * @package    tool_lp
 * @copyright  2019 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery'], function($) {

    /**
     * ModuleNavigation
     *
     * @param {String} moduleSelector The selector of the module element.
     * @param {String} baseUrl The base url for the page (no params).
     * @param {Number} courseId The course id
     * @param {Number} moduleId The activity module (filter)
     */
    var ModuleNavigation = function(moduleSelector, baseUrl, courseId, moduleId) {
        this._baseUrl = baseUrl;
        this._moduleId = moduleId;
        this._courseId = courseId;

        $(moduleSelector).on('change', this._moduleChanged.bind(this));
    };

    /**
     * The module was changed in the select list.
     *
     * @method _moduleChanged
     * @param {Event} e the event
     */
    ModuleNavigation.prototype._moduleChanged = function(e) {
        var newModuleId = $(e.target).val();
        var queryStr = '?mod=' + newModuleId + '&courseid=' + this._courseId;
        document.location = this._baseUrl + queryStr;
    };

    /** @type {Number} The id of the course. */
    ModuleNavigation.prototype._courseId = null;
    /** @type {Number} The id of the module. */
    ModuleNavigation.prototype._moduleId = null;
    /** @type {String} Plugin base url. */
    ModuleNavigation.prototype._baseUrl = null;

    return /** @alias module:tool_lp/module_navigation */ ModuleNavigation;
});
