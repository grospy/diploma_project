//

/**
 * Enhance a textarea with auto growing rows to fit the content.
 *
 * @module     core/auto_rows
 * @class      auto_rows
 * @package    core
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.2
 */
define(['jquery'], function($) {
    var SELECTORS = {
        ELEMENT: '[data-auto-rows]'
    };

    var EVENTS = {
        ROW_CHANGE: 'autorows:rowchange',
    };

    /**
     * Determine how many rows should be set for the given element.
     *
     * @method calculateRows
     * @param {jQuery} element The textarea element
     * @return {int} The number of rows for the element
     * @private
     */
    var calculateRows = function(element) {
        var currentRows = element.attr('rows');
        var minRows = element.data('min-rows');
        var maxRows = element.attr('data-max-rows');

        var height = element.height();
        var innerHeight = element.innerHeight();
        var padding = innerHeight - height;

        var scrollHeight = element[0].scrollHeight;
        var rows = (scrollHeight - padding) / (height / currentRows);

        // Remove the height styling to let the height be calculated automatically
        // based on the row attribute.
        element.css('height', '');

        if (rows < minRows) {
            return minRows;
        } else if (maxRows && rows >= maxRows) {
            return maxRows;
        } else {
            return rows;
        }
    };

    /**
     * Listener for change events to trigger resizing of the element.
     *
     * @method changeListener
     * @param {Event} e The triggered event.
     * @private
     */
    var changeListener = function(e) {
        var element = $(e.target);
        var minRows = element.data('min-rows');
        var currentRows = element.attr('rows');

        if (typeof minRows === "undefined") {
            element.data('min-rows', currentRows);
        }

        // Reset element to single row so that the scroll height of the
        // element is correctly calculated each time.
        element.attr('rows', 1);
        var rows = calculateRows(element);
        element.attr('rows', rows);

        if (rows != currentRows) {
            element.trigger(EVENTS.ROW_CHANGE);
        }
    };

    /**
     * Add the event listeners for all text areas within the given element.
     *
     * @method init
     * @param {jQuery|selector} root The container element of all enhanced text areas
     * @public
     */
    var init = function(root) {
        if ($(root).data('auto-rows')) {
            $(root).on('input propertychange', changeListener.bind(this));
        } else {
            $(root).on('input propertychange', SELECTORS.ELEMENT, changeListener.bind(this));
        }
    };

    return /** @module core/auto_rows */ {
        init: init,
        events: EVENTS,
    };
});
