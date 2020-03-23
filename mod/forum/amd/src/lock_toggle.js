//

/**
 * Handle the manual locking of individual discussions
 *
 * @module     mod_forum/lock_toggle
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
    ], function(
        $,
        Templates,
        Notification,
        Repository,
        Selectors
    ) {

    /**
     * Register event listeners for the subscription toggle.
     *
     * @param {object} root The discussion list root element
     * @param {boolean} preventDefault Should the default action of the event be prevented
     */
    var registerEventListeners = function(root, preventDefault) {
        root.on('click', Selectors.lock.toggle, function(e) {
            var toggleElement = $(this);
            var forumId = toggleElement.data('forumid');
            var discussionId = toggleElement.data('discussionid');
            var state = toggleElement.data('state');

            Repository.setDiscussionLockState(forumId, discussionId, state)
                .then(function() {
                    return location.reload();
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
