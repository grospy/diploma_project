//

/**
 * Contain the logic for the cancel modal.
 *
 * @module     core/modal_cancel
 * @class      modal_cancel
 * @package    core
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/notification', 'core/custom_interaction_events', 'core/modal', 'core/modal_events'],
        function($, Notification, CustomEvents, Modal, ModalEvents) {

    var SELECTORS = {
        CANCEL_BUTTON: '[data-action="cancel"]',
    };

    /**
     * Constructor for the Modal.
     *
     * @param {object} root The root jQuery element for the modal
     */
    var ModalCancel = function(root) {
        Modal.call(this, root);

        if (!this.getFooter().find(SELECTORS.CANCEL_BUTTON).length) {
            Notification.exception({message: 'No cancel button found'});
        }
    };

    ModalCancel.prototype = Object.create(Modal.prototype);
    ModalCancel.prototype.constructor = ModalCancel;

    /**
     * Override parent implementation to prevent changing the footer content.
     */
    ModalCancel.prototype.setFooter = function() {
        Notification.exception({message: 'Can not change the footer of a cancel modal'});
        return;
    };

    /**
     * Set up all of the event handling for the modal.
     *
     * @method registerEventListeners
     */
    ModalCancel.prototype.registerEventListeners = function() {
        // Apply parent event listeners.
        Modal.prototype.registerEventListeners.call(this);

        this.getModal().on(CustomEvents.events.activate, SELECTORS.CANCEL_BUTTON, function(e, data) {
            var cancelEvent = $.Event(ModalEvents.cancel);
            this.getRoot().trigger(cancelEvent, this);

            if (!cancelEvent.isDefaultPrevented()) {
                this.hide();
                data.originalEvent.preventDefault();
            }
        }.bind(this));
    };

    return ModalCancel;
});
