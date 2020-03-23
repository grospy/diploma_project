//

/**
 * Potential contexts selector module.
 *
 * @module     tool_analytics/potential-contexts
 * @class      potential-contexts
 * @package    tool_analytics
 * @copyright  2019 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'core/ajax'], function($, Ajax) {

    return /** @alias module:tool_analytics/potential-contexts */ {

        processResults: function(selector, results) {
            var contexts = [];
            if ($.isArray(results)) {
                $.each(results, function(index, context) {
                    contexts.push({
                        value: context.id,
                        label: context.name
                    });
                });
                return contexts;

            } else {
                return results;
            }
        },

        transport: function(selector, query, success, failure) {
            var promise;

            let modelid = $(selector).attr('modelid') || null;
            promise = Ajax.call([{
                methodname: 'tool_analytics_potential_contexts',
                args: {
                    query: query,
                    modelid: modelid
                }
            }]);

            promise[0].then(success).fail(failure);
        }

    };

});
