//

/**
 * Controls the message popover in the nav bar.
 *
 * @module     core_message/message_popover
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(
[
    'jquery',
    'core/custom_interaction_events',
    'core/pubsub',
    'core_message/message_drawer_events'
],
function(
    $,
    CustomEvents,
    PubSub,
    MessageDrawerEvents
) {
    var SELECTORS = {
        COUNT_CONTAINER: '[data-region="count-container"]'
    };

    /**
     * Toggle the message drawer visibility.
     */
    var toggleMessageDrawerVisibility = function() {
        PubSub.publish(MessageDrawerEvents.TOGGLE_VISIBILITY);
    };

    /**
     * Decrement the unread conversation count in the nav bar if a conversation
     * is read. When there are no unread conversations then hide the counter.
     *
     * @param {Object} root The root element for the popover.
     * @return {Function}
     */
    var handleDecrementConversationCount = function(root) {
        return function() {
            var countContainer = root.find(SELECTORS.COUNT_CONTAINER);
            var count = parseInt(countContainer.text(), 10);

            if (isNaN(count)) {
                countContainer.addClass('hidden');
            } else if (!count || count < 2) {
                countContainer.addClass('hidden');
            } else {
                count = count - 1;
                countContainer.text(count);
            }
        };
    };

    /**
     * Add events listeners for when the popover icon is clicked and when conversations
     * are read.
     *
     * @param {Object} root The root element for the popover.
     */
    var registerEventListeners = function(root) {
        CustomEvents.define(root, [CustomEvents.events.activate]);

        root.on(CustomEvents.events.activate, function(e, data) {
            toggleMessageDrawerVisibility();
            data.originalEvent.preventDefault();
        });

        PubSub.subscribe(MessageDrawerEvents.CONVERSATION_READ, handleDecrementConversationCount(root));
        PubSub.subscribe(MessageDrawerEvents.CONTACT_REQUEST_ACCEPTED, handleDecrementConversationCount(root));
        PubSub.subscribe(MessageDrawerEvents.CONTACT_REQUEST_DECLINED, handleDecrementConversationCount(root));
    };

    /**
     * Initialise the message popover.
     *
     * @param {Object} root The root element for the popover.
     */
    var init = function(root) {
        root = $(root);
        registerEventListeners(root);
    };

    return {
        init: init,
    };
});
