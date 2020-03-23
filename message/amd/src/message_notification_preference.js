//

/**
 * Controls the preference for an individual notification type on the
 * message preference page.
 *
 * @module     core_message/message_notification_preference
 * @class      message_notification_preference
 * @package    message
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core_message/notification_preference'],
        function($, NotificationPreference) {

    var SELECTORS = {
        PREFERENCE_KEY: '[data-preference-key]',
    };

    /**
     * Constructor for the Preference.
     *
     * @param {object} element jQuery object root element of the preference
     * @param {int} userId The current user id
     */
    var MessageNotificationPreference = function(element, userId) {
        NotificationPreference.call(this, element, userId);
    };

    /**
     * Clone the parent prototype.
     */
    MessageNotificationPreference.prototype = Object.create(NotificationPreference.prototype);

    /**
     * Set constructor.
     */
    MessageNotificationPreference.prototype.constructor = MessageNotificationPreference;

    /**
     * Get the unique prefix key that identifies this user preference.
     *
     * @method getPreferenceKey
     * @return {string}
     */
    MessageNotificationPreference.prototype.getPreferenceKey = function() {
        return this.root.find(SELECTORS.PREFERENCE_KEY).attr('data-preference-key');
    };

    return MessageNotificationPreference;
});
