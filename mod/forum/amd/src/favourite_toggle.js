//

/**
 * Handle discussion subscription toggling on a discussion list in
 * the forum view.
 *
 * @module     mod_forum/favourite_toggle
 * @package    mod_forum
 * @copyright  2019 Peter Dias <peter@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([
        'jquery',
        'core/templates',
        'core/notification',
        'mod_forum/repository',
        'mod_forum/selectors',
        'core/str',
    ], function(
        $,
        Templates,
        Notification,
        Repository,
        Selectors,
        String
    ) {

    /**
     * Register event listeners for the subscription toggle.
     *
     * @param {object} root The discussion list root element
     * @param {boolean} preventDefault Should the default action of the event be prevented
     * @param {function} callback Success callback
     */
    var registerEventListeners = function(root, preventDefault, callback) {
        root.on('click', Selectors.favourite.toggle, function(e) {
            var toggleElement = $(this);
            var forumId = toggleElement.data('forumid');
            var discussionId = toggleElement.data('discussionid');
            var subscriptionState = toggleElement.data('targetstate');

            Repository.setFavouriteDiscussionState(forumId, discussionId, subscriptionState)
                .then(function(context) {
                    return callback(toggleElement, context);
                })
                .then(function() {
                    return String.get_string("favouriteupdated", "forum")
                        .done(function(s) {
                            return Notification.addNotification({
                                message: s,
                                type: "info"
                            });
                        });
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
