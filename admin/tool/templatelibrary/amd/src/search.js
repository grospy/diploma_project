//

/**
 * This module adds ajax search functions to the template library page.
 *
 * @module     tool_templatelibrary/search
 * @package    tool_templatelibrary
 * @copyright  2015 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/ajax', 'core/log', 'core/notification', 'core/templates', 'core/config'],
       function($, ajax, log, notification, templates, config) {

    /**
     * The ajax call has returned with a new list of templates.
     *
     * @method reloadListTemplate
     * @param {String[]} templateList List of template ids.
     */
    var reloadListTemplate = function(templateList) {
        templates.render('tool_templatelibrary/search_results', {templates: templateList})
            .done(function(result, js) {
                templates.replaceNode($('[data-region="searchresults"]'), result, js);
            }).fail(notification.exception);
    };

    /**
     * Get the current values for the form inputs and refresh the list of matching templates.
     *
     * @method refreshSearch
     * @param {String} themename The naeme of the theme.
     */
    var refreshSearch = function(themename) {
        var componentStr = $('[data-field="component"]').val();
        var searchStr = $('[data-field="search"]').val();

        // Trigger the search.
        document.location.hash = searchStr;

        ajax.call([
            {methodname: 'tool_templatelibrary_list_templates',
              args: {component: componentStr, search: searchStr, themename: themename},
              done: reloadListTemplate,
              fail: notification.exception}
        ], true, false);
    };

    var throttle = null;

    /**
     * Call the specified function after a delay. If this function is called again before the function is executed,
     * the function will only be executed once.
     *
     * @method queueRefresh
     * @param {function} callback
     * @param {Number} delay The time in milliseconds to delay.
     */
    var queueRefresh = function(callback, delay) {
        if (throttle !== null) {
            window.clearTimeout(throttle);
        }

        throttle = window.setTimeout(function() {
            callback();
            throttle = null;
        }, delay);
    };

    var changeHandler = function() {
        queueRefresh(refreshSearch.bind(this, config.theme), 400);
    };
    // Add change handlers to refresh the list.
    $('[data-region="list-templates"]').on('change', '[data-field="component"]', changeHandler);
    $('[data-region="list-templates"]').on('input', '[data-field="search"]', changeHandler);

    $('[data-field="search"]').val(document.location.hash.replace('#', ''));
    refreshSearch(config.theme);
    return {};
});
