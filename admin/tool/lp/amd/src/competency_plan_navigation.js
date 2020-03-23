//

/**
 * Event click on selecting competency in the competency autocomplete.
 *
 * @package    tool_lp
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery'], function($) {

    /**
     * CompetencyPlanNavigation
     *
     * @param {String} competencySelector The selector of the competency element.
     * @param {String} baseUrl The base url for the page (no params).
     * @param {Number} userId The user id
     * @param {Number} competencyId The competency id
     * @param {Number} planId The plan id
     */
    var CompetencyPlanNavigation = function(competencySelector, baseUrl, userId, competencyId, planId) {
        this._baseUrl = baseUrl;
        this._userId = userId + '';
        this._competencyId = competencyId + '';
        this._planId = planId;
        this._ignoreFirstCompetency = true;

        $(competencySelector).on('change', this._competencyChanged.bind(this));
    };

    /**
     * The competency was changed in the select list.
     *
     * @method _competencyChanged
     * @param {Event} e
     */
    CompetencyPlanNavigation.prototype._competencyChanged = function(e) {
        if (this._ignoreFirstCompetency) {
            this._ignoreFirstCompetency = false;
            return;
        }
        var newCompetencyId = $(e.target).val();
        var queryStr = '?userid=' + this._userId + '&planid=' + this._planId + '&competencyid=' + newCompetencyId;
        document.location = this._baseUrl + queryStr;
    };

    /** @type {Number} The id of the competency. */
    CompetencyPlanNavigation.prototype._competencyId = null;
    /** @type {Number} The id of the user. */
    CompetencyPlanNavigation.prototype._userId = null;
    /** @type {Number} The id of the plan. */
    CompetencyPlanNavigation.prototype._planId = null;
    /** @type {String} Plugin base url. */
    CompetencyPlanNavigation.prototype._baseUrl = null;
    /** @type {Boolean} Ignore the first change event for competencies. */
    CompetencyPlanNavigation.prototype._ignoreFirstCompetency = null;

    return /** @alias module:tool_lp/competency_plan_navigation */ CompetencyPlanNavigation;

});
