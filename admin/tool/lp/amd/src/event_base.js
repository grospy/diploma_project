//

/**
 * Event base javascript module.
 *
 * @module     tool_lp/event_base
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery'], function($) {

    /**
     * Base class.
     */
    var Base = function() {
        this._eventNode = $('<div></div>');
    };

    /** @type {Node} The node we attach the events to. */
    Base.prototype._eventNode = null;

    /**
     * Register an event listener.
     *
     * @param {String} type The event type.
     * @param {Function} handler The event listener.
     * @method on
     */
    Base.prototype.on = function(type, handler) {
        this._eventNode.on(type, handler);
    };

    /**
     * Trigger an event.
     *
     * @param {String} type The type of event.
     * @param {Object} data The data to pass to the listeners.
     * @method _trigger
     */
    Base.prototype._trigger = function(type, data) {
        this._eventNode.trigger(type, [data]);
    };

    return /** @alias module:tool_lp/event_base */ Base;
});
