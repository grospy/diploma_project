//

/**
 * Contain the events a modal can fire.
 *
 * @module     core/modal_events
 * @class      modal_events
 * @package    core
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([], function() {
    return {
        // Default events.
        shown: 'modal:shown',
        hidden: 'modal:hidden',
        destroyed: 'modal:destroyed',
        bodyRendered: 'modal:bodyRendered',
        // ModalSaveCancel events.
        save: 'modal-save-cancel:save',
        cancel: 'modal-save-cancel:cancel',
    };
});
