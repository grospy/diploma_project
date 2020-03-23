//

/**
 * Contain the events that can be fired in the notification area on
 * the notifications page.
 *
 * @module     message_popup/notification_area_events
 * @class      notification_area_events
 * @package    core
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([], function() {
    return {
        showNotification: 'notification-area-events:showNotification',
        notificationShown: 'notification-area-events:notificationShown',
    };
});
