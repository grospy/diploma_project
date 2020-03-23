//

/**
 * Retrieves notifications from the server.
 *
 * @module     message_popup/notification_repository
 * @class      notification_repository
 * @package    message_popup
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/ajax', 'core/notification'], function(Ajax, Notification) {
    /**
     * Retrieve a list of notifications from the server.
     *
     * @param {object} args The request arguments
     * @return {object} jQuery promise
     */
    var query = function(args) {
        if (typeof args.limit === 'undefined') {
            args.limit = 20;
        }

        if (typeof args.offset === 'undefined') {
            args.offset = 0;
        }

        var request = {
            methodname: 'message_popup_get_popup_notifications',
            args: args
        };

        var promise = Ajax.call([request])[0];

        promise.fail(Notification.exception);

        return promise;
    };

    /**
     * Get the number of unread notifications from the server.
     *
     * @param {object} args The request arguments
     * @return {object} jQuery promise
     */
    var countUnread = function(args) {
        var request = {
            methodname: 'message_popup_get_unread_popup_notification_count',
            args: args
        };

        var promise = Ajax.call([request])[0];

        promise.fail(Notification.exception);

        return promise;
    };

    /**
     * Mark all notifications for the given user as read.
     *
     * @param {object} args The request arguments:
     * @return {object} jQuery promise
     */
    var markAllAsRead = function(args) {
        var request = {
            methodname: 'core_message_mark_all_notifications_as_read',
            args: args
        };

        var promise = Ajax.call([request])[0];

        promise.fail(Notification.exception);

        return promise;
    };

    /**
     * Mark a specific notification as read.
     *
     * @param {int} id The notification id
     * @param {int} timeread The read timestamp (optional)
     * @return {object} jQuery promise
     */
    var markAsRead = function(id, timeread) {
        var args = {
            notificationid: id,
        };

        if (timeread) {
            args.timeread = timeread;
        }

        var request = {
            methodname: 'core_message_mark_notification_read',
            args: args
        };

        var promise = Ajax.call([request])[0];

        promise.fail(Notification.exception);

        return promise;
    };

    return {
        query: query,
        countUnread: countUnread,
        markAllAsRead: markAllAsRead,
        markAsRead: markAsRead,
    };
});
