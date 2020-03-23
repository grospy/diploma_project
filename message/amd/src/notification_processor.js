//

/**
 * Represents the notification processor (e.g. email, popup, jabber)
 *
 * @module     core_message/notification_processor
 * @class      notification_processor
 * @package    message
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery'], function($) {
    var SELECTORS = {
        STATE_NONE: '[data-state="none"]',
        STATE_BOTH: '[data-state="both"]',
        STATE_LOGGED_IN: '[data-state="loggedin"]',
        STATE_LOGGED_OFF: '[data-state="loggedoff"]',
    };

    /**
     * Constructor for the notification processor.
     *
     * @param {object} element jQuery object root element of the processor
     */
    var NotificationProcessor = function(element) {
        this.root = $(element);
    };

    /**
     * Get the processor name.
     *
     * @method getName
     * @return {string}
     */
    NotificationProcessor.prototype.getName = function() {
        return this.root.attr('data-processor-name');
    };

    /**
     * Check if the processor is enabled when the user is logged in.
     *
     * @method isLoggedInEnabled
     * @return {bool}
     */
    NotificationProcessor.prototype.isLoggedInEnabled = function() {
        var none = this.root.find(SELECTORS.STATE_NONE).find('input');

        if (none.prop('checked')) {
            return false;
        }

        var both = this.root.find(SELECTORS.STATE_BOTH).find('input');
        var loggedIn = this.root.find(SELECTORS.STATE_LOGGED_IN).find('input');

        return loggedIn.prop('checked') || both.prop('checked');
    };

    /**
     * Check if the processor is enabled when the user is logged out.
     *
     * @method isLoggedOffEnabled
     * @return {bool}
     */
    NotificationProcessor.prototype.isLoggedOffEnabled = function() {
        var none = this.root.find(SELECTORS.STATE_NONE).find('input');

        if (none.prop('checked')) {
            return false;
        }

        var both = this.root.find(SELECTORS.STATE_BOTH).find('input');
        var loggedOff = this.root.find(SELECTORS.STATE_LOGGED_OFF).find('input');

        return loggedOff.prop('checked') || both.prop('checked');
    };

    return NotificationProcessor;
});
