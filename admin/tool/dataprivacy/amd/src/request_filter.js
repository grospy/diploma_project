//

/**
 * JS module for the data requests filter.
 *
 * @module     tool_dataprivacy/request_filter
 * @package    tool_dataprivacy
 * @copyright  2018 Jun Pataleta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/form-autocomplete', 'core/str', 'core/notification'], function($, Autocomplete, Str, Notification) {

    /**
     * Selectors.
     *
     * @access private
     * @type {{REQUEST_FILTERS: string}}
     */
    var SELECTORS = {
        REQUEST_FILTERS: '#request-filters'
    };

    /**
     * Init function.
     *
     * @method init
     * @private
     */
    var init = function() {
        var stringkeys = [
            {
                key: 'filter',
                component: 'moodle'
            },
            {
                key: 'nofiltersapplied',
                component: 'moodle'
            }
        ];

        Str.get_strings(stringkeys).then(function(langstrings) {
            var placeholder = langstrings[0];
            var noSelectionString = langstrings[1];
            return Autocomplete.enhance(SELECTORS.REQUEST_FILTERS, false, '', placeholder, false, true, noSelectionString, true);
        }).fail(Notification.exception);

        var last = $(SELECTORS.REQUEST_FILTERS).val();
        $(SELECTORS.REQUEST_FILTERS).on('change', function() {
            var current = $(this).val();
            // Prevent form from submitting unnecessarily, eg. on blur when no filter is selected.
            if (last.join(',') !== current.join(',')) {
                // If we're submitting without filters, set the hidden input 'filters-cleared' to 1.
                if (current.length === 0) {
                    $('#filters-cleared').val(1);
                }
                $(this.form).submit();
            }
        });
    };

    return /** @alias module:core/form-autocomplete */ {
        /**
         * Initialise the unified user filter.
         *
         * @method init
         */
        init: function() {
            init();
        }
    };
});
