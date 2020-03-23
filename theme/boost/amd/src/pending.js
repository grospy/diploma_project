//

/**
 * Add Pending JS checks to stock Bootstrap transitions.
 *
 * @module     theme_boost/pending
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery'], function($) {
    var moduleTransitions = {
        alert: [
            // Alert.
            {
                start: 'close',
                end: 'closed',
            },
        ],

        carousel: [
            {
                start: 'slide',
                end: 'slid',
            },
        ],

        collapse: [
            {
                start: 'hide',
                end: 'hidden',
            },
            {
                start: 'show',
                end: 'shown',
            },
        ],

        dropdown: [
            {
                start: 'hide',
                end: 'hidden',
            },
            {
                start: 'show',
                end: 'shown',
            },
        ],

        modal: [
            {
                start: 'hide',
                end: 'hidden',
            },
            {
                start: 'show',
                end: 'shown',
            },
        ],

        popover: [
            {
                start: 'hide',
                end: 'hidden',
            },
            {
                start: 'show',
                end: 'shown',
            },
        ],

        tab: [
            {
                start: 'hide',
                end: 'hidden',
            },
            {
                start: 'show',
                end: 'shown',
            },
        ],

        toast: [
            {
                start: 'hide',
                end: 'hidden',
            },
            {
                start: 'show',
                end: 'shown',
            },
        ],

        tooltip: [
            {
                start: 'hide',
                end: 'hidden',
            },
            {
                start: 'show',
                end: 'shown',
            },
        ],
    };

    Object.keys(moduleTransitions).forEach(function(key) {
        moduleTransitions[key].forEach(function(pair) {
            var eventStart = pair.start + '.bs.' + key;
            var eventEnd = pair.end + '.bs.' + key;
            $(document.body).on(eventStart, function() {
                M.util.js_pending(eventEnd);
            });

            $(document.body).on(eventEnd, function() {
                M.util.js_complete(eventEnd);
            });
        });
    });
});
