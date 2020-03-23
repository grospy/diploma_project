//

/**
 * Search user selector module.
 *
 * @module core_search/form-search-user-selector
 * @class form-search-user-selector
 * @package core_search
 * @copyright 2017 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'core/ajax', 'core/templates'], function($, Ajax, Templates) {

    return /** @alias module:core_search/form-search-user-selector */ {

        processResults: function(selector, results) {
            var users = [];
            $.each(results, function(index, user) {
                users.push({
                    value: user.id,
                    label: user._label
                });
            });
            return users;
        },

        transport: function(selector, query, success, failure) {
            var promise;

            // Search within specific course if known and if the 'search within' dropdown is set
            // to search within course or activity.
            var args = {query: query};
            var courseid = $(selector).attr('withincourseid');
            if (typeof courseid !== "undefined" && $('#id_searchwithin').val() !== '') {
                args.courseid = courseid;
            } else {
                args.courseid = 0;
            }

            // Call AJAX request.
            promise = Ajax.call([{methodname: 'core_search_get_relevant_users', args: args}]);

            // When AJAX request returns, handle the results.
            promise[0].then(function(results) {
                var promises = [];

                // Render label with user name and picture.
                $.each(results, function(index, user) {
                    promises.push(Templates.render('core_search/form-user-selector-suggestion', user));
                });

                // Apply the label to the results.
                return $.when.apply($.when, promises).then(function() {
                    var args = arguments;
                    var i = 0;
                    $.each(results, function(index, user) {
                        user._label = args[i++];
                    });
                    success(results);
                    return;
                });

            }).fail(failure);
        }

    };

});
