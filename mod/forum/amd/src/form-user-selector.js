//

/**
 * Enrolled user selector module.
 *
 * @module     mod_forum/form-user-selector
 * @class      form-user-selector
 * @package    mod_forum
 * @copyright  2019 Shamim Rezaie
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'core/ajax', 'core/templates'], function($, Ajax, Templates) {
    return /** @alias module:mod_forum/form-user-selector */ {
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
            var courseid = $(selector).attr('courseid');

            promise = Ajax.call([{
                methodname: 'core_enrol_search_users',
                args: {
                    courseid: courseid,
                    search: query,
                    searchanywhere: true,
                    page: 0,
                    perpage: 30
                }
            }]);

            promise[0].then(function(results) {
                var promises = [],
                    i = 0;

                // Render the label.
                $.each(results, function(index, user) {
                    promises.push(Templates.render('mod_forum/form-user-selector-suggestion', user));
                });

                // Apply the label to the results.
                return $.when.apply($.when, promises).then(function() {
                    var args = arguments;
                    $.each(results, function(index, user) {
                        user._label = args[i];
                        i++;
                    });
                    success(results);
                    return;
                });

            }).fail(failure);
        }

    };

});
