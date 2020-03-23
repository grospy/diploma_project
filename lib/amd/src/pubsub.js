//

/**
 * A simple Javascript PubSub implementation.
 *
 * @module     core/pubsub
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import Pending from 'core/pending';

const events = {};

/**
 * Subscribe to an event.
 *
 * @param {string} eventName The name of the event to subscribe to.
 * @param {function} callback The callback function to run when eventName occurs.
 */
export const subscribe = function(eventName, callback) {
    events[eventName] = events[eventName] || [];
    events[eventName].push(callback);
};

/**
 * Unsubscribe from an event.
 *
 * @param {string} eventName The name of the event to unsubscribe from.
 * @param {function} callback The callback to unsubscribe.
 */
export const unsubscribe = function(eventName, callback) {
    if (events[eventName]) {
        for (var i = 0; i < events[eventName].length; i++) {
            if (events[eventName][i] === callback) {
                events[eventName].splice(i, 1);
                break;
            }
        }
    }
};

/**
 * Publish an event to all subscribers.
 *
 * @param {string} eventName The name of the event to publish.
 * @param {any} data The data to provide to the subscribed callbacks.
 */
export const publish = function(eventName, data) {
    const pendingPromise = new Pending("Publishing " + eventName);
    if (events[eventName]) {
        events[eventName].forEach(function(callback) {
            callback(data);
        });
    }
    pendingPromise.resolve();
};
