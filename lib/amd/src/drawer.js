//

/**
 * Controls the drawer.
 *
 * @module     core/drawer
 * @copyright  2019 Jun Pataleta <jun@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import $ from 'jquery';
import * as PubSub from 'core/pubsub';
import DrawerEvents from 'core/drawer_events';

/**
 * Show the drawer.
 *
 * @param {Object} root The drawer container.
 */
const show = (root) => {
    root.removeClass('hidden');
    root.attr('aria-expanded', true);
    root.attr('aria-hidden', false);
    root.focus();

    PubSub.publish(DrawerEvents.DRAWER_SHOWN, root);
};

/**
 * Hide the drawer.
 *
 * @param {Object} root The drawer container.
 */
const hide = (root) => {
    root.addClass('hidden');
    root.attr('aria-expanded', false);
    root.attr('aria-hidden', true);
    PubSub.publish(DrawerEvents.DRAWER_HIDDEN, root);
};

/**
 * Check if the drawer is visible.
 *
 * @param {Object} root The drawer container.
 * @return {boolean}
 */
const isVisible = (root) => {
    let isHidden = root.hasClass('hidden');
    return !isHidden;
};

/**
 * Toggle the drawer visibility.
 *
 * @param {Object} root The drawer container.
 */
const toggle = (root) => {
    if (isVisible(root)) {
        hide(root);
    } else {
        show(root);
    }
};

/**
 * Add event listeners to toggle the drawer.
 *
 * @param {Object} root The drawer container.
 * @param {Object} toggleElements The toggle elements.
 */
const registerToggles = (root, toggleElements) => {
    let openTrigger = null;
    toggleElements.attr('aria-expanded', isVisible(root));

    toggleElements.on('click', (e) => {
        e.preventDefault();
        const wasVisible = isVisible(root);
        toggle(root);
        toggleElements.attr('aria-expanded', !wasVisible);

        if (!wasVisible) {
            // Remember which trigger element opened the drawer.
            openTrigger = toggleElements.filter((index, element) => {
                return element == e.target || element.contains(e.target);
            });
        } else if (openTrigger) {
            // The drawer has gone from open to close so we need to set the focus back
            // to the element that openend it.
            openTrigger.focus();
            openTrigger = null;
        }
    });
};

/**
 * Find the root element of the drawer based on the using the drawer content root's ID.
 *
 * @param {Object} contentRoot The drawer content's root element.
 * @returns {*|jQuery}
 */
const getDrawerRoot = (contentRoot) => {
    contentRoot = $(contentRoot);
    return contentRoot.closest('[data-region="right-hand-drawer"]');
};

export default {
    hide: hide,
    show: show,
    isVisible: isVisible,
    toggle: toggle,
    registerToggles: registerToggles,
    getDrawerRoot: getDrawerRoot
};
