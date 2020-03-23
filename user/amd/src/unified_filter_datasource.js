//

/**
 * Datasource for the core_user/unified_filter.
 *
 * This module is compatible with core/form-autocomplete.
 *
 * @package    core_user
 * @copyright  2017 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'core/ajax', 'core/notification'], function($, Ajax, Notification) {

    return /** @alias module:core_user/unified_filter_datasource */ {
        /**
         * List filter options.
         *
         * @param {String} selector The select element selector.
         * @param {String} query The query string.
         * @return {Promise}
         */
        list: function(selector, query) {
            var filteredOptions = [];

            var el = $(selector);
            var originalOptions = $(selector).data('originaloptionsjson');
            var selectedFilters = el.val();
            $.each(originalOptions, function(index, option) {
                // Skip option if it does not contain the query string.
                if ($.trim(query) !== '' && option.label.toLocaleLowerCase().indexOf(query.toLocaleLowerCase()) === -1) {
                    return true;
                }
                // Skip filters that have already been selected.
                if ($.inArray(option.value, selectedFilters) > -1) {
                    return true;
                }

                filteredOptions.push(option);
                return true;
            });

            var deferred = new $.Deferred();
            deferred.resolve(filteredOptions);

            return deferred.promise();
        },

        /**
         * Process the results for auto complete elements.
         *
         * @param {String} selector The selector of the auto complete element.
         * @param {Array} results An array or results.
         * @return {Array} New array of results.
         */
        processResults: function(selector, results) {
            var options = [];
            $.each(results, function(index, data) {
                options.push({
                    value: data.value,
                    label: data.label
                });
            });
            return options;
        },

        /**
         * Source of data for Ajax element.
         *
         * @param {String} selector The selector of the auto complete element.
         * @param {String} query The query string.
         * @param {Function} callback A callback function receiving an array of results.
         */
        /* eslint-disable promise/no-callback-in-promise */
        transport: function(selector, query, callback) {
            this.list(selector, query).then(callback).catch(Notification.exception);
        }
    };

});
