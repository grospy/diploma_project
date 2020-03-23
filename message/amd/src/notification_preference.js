//

/**
 * Controls the preference for an individual notification type on the
 * message preference page.
 *
 * @module     core_message/notification_preference
 * @class      notification_preference
 * @package    message
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/ajax', 'core/notification', 'core_message/notification_processor'],
        function($, Ajax, Notification, NotificationProcessor) {

    var SELECTORS = {
        PROCESSOR: '[data-processor-name]',
        STATE_INPUTS: '[data-state] input',
    };

    /**
     * Constructor for the Preference.
     *
     * @param {object} element jQuery object root element of the preference
     * @param {int} userId The current user id
     */
    var NotificationPreference = function(element, userId) {
        this.root = $(element);
        this.userId = userId;
    };

    /**
     * Get the unique prefix key that identifies this user preference.
     *
     * @method getPreferenceKey
     * @return {string}
     */
    NotificationPreference.prototype.getPreferenceKey = function() {
        return this.root.attr('data-preference-key');
    };

    /**
     * Get the unique key for the logged in preference.
     *
     * @method getLoggedInPreferenceKey
     * @return {string}
     */
    NotificationPreference.prototype.getLoggedInPreferenceKey = function() {
        return this.getPreferenceKey() + '_loggedin';
    };

    /**
     * Get the unique key for the logged off preference.
     *
     * @method getLoggedOffPreferenceKey
     * @return {string}
     */
    NotificationPreference.prototype.getLoggedOffPreferenceKey = function() {
        return this.getPreferenceKey() + '_loggedoff';
    };

    /**
     * Get the list of Processors available for this preference.
     *
     * @method getProcessors
     * @return {array}
     */
    NotificationPreference.prototype.getProcessors = function() {
        return this.root.find(SELECTORS.PROCESSOR).map(function(index, element) {
            return new NotificationProcessor($(element));
        });
    };

    /**
     * Flag the preference as loading.
     *
     * @method startLoading
     */
    NotificationPreference.prototype.startLoading = function() {
        this.root.addClass('loading');
        this.root.find(SELECTORS.STATE_INPUTS).prop('disabled', true);
    };

    /**
     * Remove the loading flag for this preference.
     *
     * @method stopLoading
     */
    NotificationPreference.prototype.stopLoading = function() {
        this.root.removeClass('loading');
        this.root.find(SELECTORS.STATE_INPUTS).prop('disabled', false);
    };

    /**
     * Check if the preference is loading.
     *
     * @method isLoading
     * @return {Boolean}
     */
    NotificationPreference.prototype.isLoading = function() {
        return this.root.hasClass('loading');
    };

    /**
     * Persist the current state of the processors for this preference.
     *
     * @method save
     * @return {object} jQuery promise
     */
    NotificationPreference.prototype.save = function() {
        if (this.isLoading()) {
            return $.Deferred().resolve();
        }

        this.startLoading();

        var loggedInValue = '';
        var loggedOffValue = '';

        this.getProcessors().each(function(index, processor) {
            if (processor.isLoggedInEnabled()) {
                if (loggedInValue === '') {
                    loggedInValue = processor.getName();
                } else {
                    loggedInValue += ',' + processor.getName();
                }
            }

            if (processor.isLoggedOffEnabled()) {
                if (loggedOffValue === '') {
                    loggedOffValue = processor.getName();
                } else {
                    loggedOffValue += ',' + processor.getName();
                }
            }
        });

        if (loggedInValue === '') {
            loggedInValue = 'none';
        }

        if (loggedOffValue === '') {
            loggedOffValue = 'none';
        }

        var args = {
            userid: this.userId,
            preferences: [
                {
                    type: this.getLoggedInPreferenceKey(),
                    value: loggedInValue,
                },
                {
                    type: this.getLoggedOffPreferenceKey(),
                    value: loggedOffValue,
                },
            ],
        };

        var request = {
            methodname: 'core_user_update_user_preferences',
            args: args,
        };

        return Ajax.call([request])[0]
            .fail(Notification.exception)
            .always(function() {
                this.stopLoading();
            }.bind(this));
    };

    return NotificationPreference;
});
