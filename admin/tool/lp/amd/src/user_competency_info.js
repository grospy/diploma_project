//

/**
 * Module to refresh a user competency summary in a page.
 *
 * @package    tool_lp
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'core/notification', 'core/ajax', 'core/templates'], function($, notification, ajax, templates) {

    /**
     * Info
     *
     * @param {JQuery} rootElement Selector to replace when the information needs updating.
     * @param {Number} competencyId The id of the competency.
     * @param {Number} userId The id of the user.
     * @param {Number} planId The id of the plan.
     * @param {Number} courseId The id of the course.
     * @param {Boolean} displayuser If we should display the user info.
     */
    var Info = function(rootElement, competencyId, userId, planId, courseId, displayuser) {
        this._rootElement = rootElement;
        this._competencyId = competencyId;
        this._userId = userId;
        this._planId = planId;
        this._courseId = courseId;
        this._valid = true;
        this._displayuser = (typeof displayuser !== 'undefined') ? displayuser : false;

        if (this._planId) {
            this._methodName = 'tool_lp_data_for_user_competency_summary_in_plan';
            this._args = {competencyid: this._competencyId, planid: this._planId};
            this._templateName = 'tool_lp/user_competency_summary_in_plan';
        } else if (this._courseId) {
            this._methodName = 'tool_lp_data_for_user_competency_summary_in_course';
            this._args = {userid: this._userId, competencyid: this._competencyId, courseid: this._courseId};
            this._templateName = 'tool_lp/user_competency_summary_in_course';
        } else {
            this._methodName = 'tool_lp_data_for_user_competency_summary';
            this._args = {userid: this._userId, competencyid: this._competencyId};
            this._templateName = 'tool_lp/user_competency_summary';
        }
    };

    /**
     * Reload the info for this user competency.
     *
     * @method reload
     */
    Info.prototype.reload = function() {
        var self = this,
            promises = [];

        if (!this._valid) {
            return;
        }

        promises = ajax.call([{
            methodname: this._methodName,
            args: this._args
        }]);

        promises[0].done(function(context) {
            // Check if we should also the user info.
            if (self._displayuser) {
                context.displayuser = true;
            }
            templates.render(self._templateName, context).done(function(html, js) {
                templates.replaceNode(self._rootElement, html, js);
            }).fail(notification.exception);
        }).fail(notification.exception);
    };

    /** @type {JQuery} The root element to replace in the DOM. */
    Info.prototype._rootElement = null;
    /** @type {Number} The id of the course. */
    Info.prototype._courseId = null;
    /** @type {Boolean} Is this module valid? */
    Info.prototype._valid = null;
    /** @type {Number} The id of the plan. */
    Info.prototype._planId = null;
    /** @type {Number} The id of the competency. */
    Info.prototype._competencyId = null;
    /** @type {Number} The id of the user. */
    Info.prototype._userId = null;
    /** @type {String} The method name to load the data. */
    Info.prototype._methodName = null;
    /** @type {Object} The arguments to load the data. */
    Info.prototype._args = null;
    /** @type {String} The template to reload the fragment. */
    Info.prototype._templateName = null;
    /** @type {Boolean} If we should display the user info? */
    Info.prototype._displayuser = false;

    return /** @alias module:tool_lp/user_competency_info */ Info;

});
