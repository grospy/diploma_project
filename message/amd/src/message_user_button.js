//

/**
 * Module to message a user from their profile page.
 *
 * @module     core_message/message_user_button
 * @copyright  2019 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/custom_interaction_events', 'core_message/message_drawer_helper'],
    function($, CustomEvents, MessageDrawerHelper) {

        /**
         * Get the id for the user being messaged.
         *
         * @param {object} element jQuery object for the button
         * @return {int}
         */
        var getUserId = function(element) {
            return parseInt(element.attr('data-userid'));
        };

        /**
         * Returns the conversation id, 0 if none.
         *
         * @param {object} element jQuery object for the button
         * @return {int}
         */
        var getConversationId = function(element) {
            return parseInt(element.attr('data-conversationid'));
        };

        /**
         * Handles opening the messaging drawer to send a
         * message to a given user.
         *
         * @method enhance
         * @param {object} element jQuery object for the button
         */
        var send = function(element) {
            element = $(element);

            CustomEvents.define(element, [CustomEvents.events.activate]);

            element.on(CustomEvents.events.activate, function(e, data) {
                var conversationid = getConversationId(element);
                if (conversationid) {
                    MessageDrawerHelper.showConversation(conversationid);
                } else {
                    MessageDrawerHelper.createConversationWithUser(getUserId(element));
                }
                e.preventDefault();
                data.originalEvent.preventDefault();
            });
        };

        return /** @alias module:core_message/message_user_button */ {
            send: send
        };
    });
