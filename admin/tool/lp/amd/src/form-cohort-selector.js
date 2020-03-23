//

/**
 * Cohort selector module.
 *
 * @module     tool_lp/form-cohort-selector
 * @class      form-cohort-selector
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'core/ajax', 'core/templates'], function($, Ajax, Templates) {

    return /** @alias module:tool_lp/form-cohort-selector */ {

        processResults: function(selector, results) {
            var cohorts = [];
            $.each(results, function(index, cohort) {
                cohorts.push({
                    value: cohort.id,
                    label: cohort._label
                });
            });
            return cohorts;
        },

        transport: function(selector, query, success, failure) {
            var promise,
                contextid = parseInt($(selector).data('contextid'), 10),
                includes = $(selector).data('includes');

            promise = Ajax.call([{
                methodname: 'tool_lp_search_cohorts',
                args: {
                    query: query,
                    context: {contextid: contextid},
                    includes: includes
                }
            }]);
            promise[0].then(function(results) {
                var promises = [],
                    i = 0;

                // Render the label.
                $.each(results.cohorts, function(index, cohort) {
                    promises.push(Templates.render('tool_lp/form-cohort-selector-suggestion', cohort));
                });

                // Apply the label to the results.
                return $.when.apply($.when, promises).then(function() {
                    var args = arguments;
                    $.each(results.cohorts, function(index, cohort) {
                        cohort._label = args[i];
                        i++;
                    });
                    success(results.cohorts);
                    return;
                });

            }).catch(failure);
        }

    };

});
