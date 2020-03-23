//

/**
 * Policy actions.
 *
 * @module     tool_policy/policyactions
 * @package    tool_policy
 * @copyright  2018 Sara Arjona (sara@moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([
    'jquery',
    'core/ajax',
    'core/notification',
    'core/modal_factory',
    'core/modal_events'],
function($, Ajax, Notification, ModalFactory, ModalEvents) {

    /**
     * PolicyActions class.
     */
    var PolicyActions = function(root) {
        this.registerEvents(root);
    };

    /**
     * Register event listeners.
     */
    PolicyActions.prototype.registerEvents = function(root) {
        root.on("click", function(e) {
            e.preventDefault();

            var versionid = $(this).data('versionid');
            var behalfid = $(this).data('behalfid');

            var params = {
                'versionid': versionid,
                'behalfid': behalfid
            };

            var request = {
                methodname: 'tool_policy_get_policy_version',
                args: params
            };

            var modalTitle = $.Deferred();
            var modalBody = $.Deferred();

            var modal = ModalFactory.create({
                title: modalTitle,
                body: modalBody,
                large: true
            })
            .then(function(modal) {
                // Handle hidden event.
                modal.getRoot().on(ModalEvents.hidden, function() {
                    // Destroy when hidden.
                    modal.destroy();
                });

                return modal;
            })
            .then(function(modal) {
                modal.show();

                return modal;
            })
            .catch(Notification.exception);

            // Make the request now that the modal is configured.
            var promises = Ajax.call([request]);
            $.when(promises[0]).then(function(data) {
                if (data.result.policy) {
                    modalTitle.resolve(data.result.policy.name);
                    modalBody.resolve(data.result.policy.content);

                    return data;
                } else {
                    throw new Error(data.warnings[0].message);
                }
            }).catch(function(message) {
                modal.then(function(modal) {
                    modal.hide();
                    modal.destroy();

                    return modal;
                })
                .catch(Notification.exception);

                return Notification.addNotification({
                    message: message,
                    type: 'error'
                });
            });
        });

    };

    return /** @alias module:tool_policy/policyactions */ {
        // Public variables and functions.

        /**
         * Initialise the actions helper.
         *
         * @method init
         * @return {PolicyActions}
         */
        'init': function(root) {
            root = $(root);
            return new PolicyActions(root);
        }
    };
});
