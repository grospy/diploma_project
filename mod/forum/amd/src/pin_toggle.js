//

/**
 * This module is the highest level module for the calendar. It is
 * responsible for initialising all of the components required for
 * the calendar to run. It also coordinates the interaction between
 * components by listening for and responding to different events
 * triggered within the calendar UI.
 *
 * @module     mod_forum/pin_toggle
 * @package    mod_forum
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([
    'jquery',
    'core/ajax',
    'core/str',
    'core/templates',
    'core/notification',
    'mod_forum/repository',
    'mod_forum/selectors',
    'core/str',
], function(
    $,
    Ajax,
    Str,
    Templates,
    Notification,
    Repository,
    Selectors,
    String
) {

    /**
     * Registery event listeners for the pin toggle.
     *
     * @param {object} root The calendar root element
     * @param {boolean} preventDefault Should the default action of the event be prevented
     * @param {function} callback Success callback
     */
    var registerEventListeners = function(root, preventDefault, callback) {
        root.on('click', Selectors.pin.toggle, function(e) {
            var toggleElement = $(this);
            var forumid = toggleElement.data('forumid');
            var discussionid = toggleElement.data('discussionid');
            var pinstate = toggleElement.data('targetstate');
            Repository.setPinDiscussionState(forumid, discussionid, pinstate)
                .then(function(context) {
                    return callback(toggleElement, context);
                })
                .then(function() {
                    return String.get_string("pinupdated", "forum")
                        .done(function(s) {
                            return Notification.addNotification({
                                message: s,
                                type: "info"
                            });
                        });
                })
                .fail(Notification.exception);

            if (preventDefault) {
                e.preventDefault();
            }
        });
    };

    return {
        init: registerEventListeners
    };
});