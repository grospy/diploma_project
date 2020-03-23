//

/**
 * Provides some helper functions to trigger actions in the message drawer.
 *
 * @module     core_message/message_drawer_helper
 * @package    message
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(
[
    'core/pubsub',
    'core_message/message_drawer_events'
],
function(
    PubSub,
    MessageDrawerEvents
) {

    /**
     * Trigger an event to create a new conversation in the message drawer.
     *
     * @param {Number} userId The user id to start a conversation.
     */
    var createConversationWithUser = function(userId) {
        PubSub.publish(MessageDrawerEvents.CREATE_CONVERSATION_WITH_USER, userId);
    };

    /**
     * Trigger an event to show the message drawer.
     */
    var show = function() {
        PubSub.publish(MessageDrawerEvents.SHOW);
    };

    /**
     * Trigger an event to show the given conversation.
     *
     * @param {int} conversationId Id for the conversation to show.
     */
    var showConversation = function(conversationId) {
        PubSub.publish(MessageDrawerEvents.SHOW_CONVERSATION, conversationId);
    };

    /**
     * Trigger an event to show messaging settings.
     */
    var showSettings = function() {
        PubSub.publish(MessageDrawerEvents.SHOW_SETTINGS);
    };

    return {
        createConversationWithUser: createConversationWithUser,
        show: show,
        showConversation: showConversation,
        showSettings: showSettings
    };
});
