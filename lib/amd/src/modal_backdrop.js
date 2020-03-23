//

/**
 * Contain the logic for modal backdrops.
 *
 * @module     core/modal_backdrop
 * @class      modal_backdrop
 * @package    core
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/templates', 'core/notification'],
     function($, Templates, Notification) {

    var SELECTORS = {
        ROOT: '[data-region="modal-backdrop"]',
    };

    /**
     * Constructor for ModalBackdrop.
     *
     * @param {object} root The root element for the modal backdrop
     */
    var ModalBackdrop = function(root) {
        this.root = $(root);
        this.isAttached = false;

        if (!this.root.is(SELECTORS.ROOT)) {
            Notification.exception({message: 'Element is not a modal backdrop'});
        }
    };

    /**
     * Get the root element of this modal backdrop.
     *
     * @method getRoot
     * @return {object} jQuery object
     */
    ModalBackdrop.prototype.getRoot = function() {
        return this.root;
    };

    /**
     * Add the modal backdrop to the page, if it hasn't already been added.
     *
     * @method attachToDOM
     */
    ModalBackdrop.prototype.attachToDOM = function() {
        if (this.isAttached) {
            return;
        }

        $('body').append(this.root);
        this.isAttached = true;
    };

    /**
     * Set the z-index value for this backdrop.
     *
     * @method setZIndex
     * @param {int} value The z-index value
     */
    ModalBackdrop.prototype.setZIndex = function(value) {
        this.root.css('z-index', value);
    };

    /**
     * Check if this backdrop is visible.
     *
     * @method isVisible
     * @return {bool}
     */
    ModalBackdrop.prototype.isVisible = function() {
        return this.root.hasClass('show');
    };

    /**
     * Check if this backdrop has CSS transitions applied.
     *
     * @method hasTransitions
     * @return {bool}
     */
    ModalBackdrop.prototype.hasTransitions = function() {
        return this.getRoot().hasClass('fade');
    };

    /**
     * Display this backdrop. The backdrop will be attached to the DOM if it hasn't
     * already been.
     *
     * @method show
     */
    ModalBackdrop.prototype.show = function() {
        if (this.isVisible()) {
            return;
        }

        if (!this.isAttached) {
            this.attachToDOM();
        }

        this.root.removeClass('hide').addClass('show');
    };

    /**
     * Hide this backdrop.
     *
     * @method hide
     */
    ModalBackdrop.prototype.hide = function() {
        if (!this.isVisible()) {
            return;
        }

        if (this.hasTransitions()) {
            // Wait for CSS transitions to complete before hiding the element.
            this.getRoot().one('transitionend webkitTransitionEnd oTransitionEnd', function() {
                this.getRoot().removeClass('show').addClass('hide');
            }.bind(this));
        } else {
            this.getRoot().removeClass('show').addClass('hide');
        }
    };

    /**
     * Remove this backdrop from the DOM.
     *
     * @method destroy
     */
    ModalBackdrop.prototype.destroy = function() {
        this.root.remove();
    };

    return ModalBackdrop;
});
