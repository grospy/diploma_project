//

/**
 * Change the course competency settings in a popup.
 *
 * @module     tool_lp/configurecoursecompetencysettings
 * @package    tool_lp
 * @copyright  2015 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery',
        'core/notification',
        'tool_lp/dialogue',
        'core/str',
        'core/ajax',
        'core/templates',
        'core/pending'
        ],
       function($, notification, Dialogue, str, ajax, templates, Pending) {

    /**
     * Constructor
     *
     * @param {String} selector - selector for the links to open the dialogue.
     */
    var settingsMod = function(selector) {
        $(selector).on('click', this.configureSettings.bind(this));
    };

    /** @type {Dialogue} Reference to the dialogue that we opened. */
    settingsMod.prototype._dialogue = null;

    /**
     * Open the configure settings dialogue.
     *
     * @param {Event} e
     * @method configureSettings
     */
    settingsMod.prototype.configureSettings = function(e) {
        var pendingPromise = new Pending();
        var courseid = $(e.target).closest('a').data('courseid');
        var currentValue = $(e.target).closest('a').data('pushratingstouserplans');
        var context = {
            courseid: courseid,
            settings: {pushratingstouserplans: currentValue}
        };
        e.preventDefault();

        $.when(
            str.get_string('configurecoursecompetencysettings', 'tool_lp'),
            templates.render('tool_lp/course_competency_settings', context),
        )
        .then(function(title, templateResult) {
            this._dialogue = new Dialogue(
                title,
                templateResult[0],
                this.addListeners.bind(this)
            );

            return this._dialogue;
        }.bind(this))
        .then(pendingPromise.resolve)
        .catch(notification.exception);
    };

    /**
     * Add the save listener to the form.
     *
     * @method addSaveListener
     */
    settingsMod.prototype.addListeners = function() {
        var save = this._find('[data-action="save"]');
        save.on('click', this.saveSettings.bind(this));
        var cancel = this._find('[data-action="cancel"]');
        cancel.on('click', this.cancelChanges.bind(this));
    };

    /**
     * Cancel the changes.
     *
     * @param {Event} e
     * @method cancelChanges
     */
    settingsMod.prototype.cancelChanges = function(e) {
        e.preventDefault();
        this._dialogue.close();
    };

    /**
     * Cancel the changes.
     *
     * @param {String} selector
     * @return {JQuery}
     */
    settingsMod.prototype._find = function(selector) {
        return $('[data-region="coursecompetencysettings"]').find(selector);
    };

    /**
     * Save the settings.
     *
     * @param {Event} e
     * @method saveSettings
     */
    settingsMod.prototype.saveSettings = function(e) {
        var pendingPromise = new Pending();
        e.preventDefault();

        var newValue = this._find('input[name="pushratingstouserplans"]:checked').val();
        var courseId = this._find('input[name="courseid"]').val();
        var settings = {pushratingstouserplans: newValue};

        ajax.call([
            {methodname: 'core_competency_update_course_competency_settings',
              args: {courseid: courseId, settings: settings}}
        ])[0]
        .then(function() {
            return this.refreshCourseCompetenciesPage();
        }.bind(this))
        .then(pendingPromise.resolve)
        .catch(notification.exception);

    };

    /**
     * Refresh the course competencies page.
     *
     * @param {Event} e
     * @method saveSettings
     */
    settingsMod.prototype.refreshCourseCompetenciesPage = function() {
        var courseId = this._find('input[name="courseid"]').val();
        var pendingPromise = new Pending();

        ajax.call([
            {methodname: 'tool_lp_data_for_course_competencies_page',
              args: {courseid: courseId, moduleid: 0}}
        ])[0]
        .then(function(context) {
            return templates.render('tool_lp/course_competencies_page', context);
        })
        .then(function(html, js) {
            templates.replaceNode($('[data-region="coursecompetenciespage"]'), html, js);
            this._dialogue.close();

            return;
        }.bind(this))
        .then(pendingPromise.resolve)
        .catch(notification.exception);
    };

    return /** @alias module:tool_lp/configurecoursecompetencysettings */ settingsMod;
});
