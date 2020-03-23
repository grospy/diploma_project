//

/**
 * Handle discussion subscription toggling on a discussion list in
 * the forum view.
 *
 * @module     mod_forum/subscription_toggle
 * @package    mod_forum
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([
        'jquery',
        'core/templates',
        'core/notification',
        'mod_forum/repository',
        'mod_forum/selectors',
        'core/pubsub',
        'mod_forum/forum_events',
    ], function(
        $,
        Templates,
        Notification,
        Repository,
        Selectors,
        PubSub,
        ForumEvents
    ) {

    /**
     * Register event listeners for the subscription toggle.
     *
     * @param {object} root The discussion list root element
     * @param {boolean} preventDefault Should the default action of the event be prevented
     * @param {function} callback Success callback
     */
    var registerEventListeners = function(root, preventDefault, callback) {
        root.on('click', Selectors.subscription.toggle, function(e) {
            var toggleElement = $(this);
            var forumId = toggleElement.data('forumid');
            var discussionId = toggleElement.data('discussionid');
            var subscriptionState = toggleElement.data('targetstate');

            Repository.setDiscussionSubscriptionState(forumId, discussionId, subscriptionState)
                .then(function(context) {
                    PubSub.publish(ForumEvents.SUBSCRIPTION_TOGGLED, {
                        discussionId: discussionId,
                        subscriptionState: subscriptionState
                    });
                    return callback(toggleElement, context);
                })
                .catch(Notification.exception);

            if (preventDefault) {
                e.preventDefault();
            }
        });
    };

    return {
        init: registerEventListeners
    };
});
