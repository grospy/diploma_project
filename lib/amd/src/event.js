//

/**
 * Global registry of core events that can be triggered/listened for.
 *
 * @module     core/event
 * @package    core
 * @class      event
 * @copyright  2015 Damyon Wiese <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.0
 */
define(['jquery', 'core/yui'],
       function($, Y) {

    return /** @alias module:core/event */ {


        // Public variables and functions.
        // These are AMD only events - no backwards compatibility for new things.
        Events: {
            FORM_FIELD_VALIDATION: "core_form-field-validation"
        },

        /**
         * Load the legacy YUI module which defines events in M.core.event and return it.
         *
         * @method getLegacyEvents
         * @return {Promise}
         */
        getLegacyEvents: function() {
            var result = $.Deferred();
            Y.use('event', 'moodle-core-event', function() {
                result.resolve(window.M.core.event);
            });
            return result.promise();
        },

        /**
         * Trigger an event using both JQuery and YUI
         *
         * @method notifyFilterContentUpdated
         * @param {string|JQuery} nodes - Selector or list of elements that were inserted.
         */
        notifyFilterContentUpdated: function(nodes) {
            nodes = $(nodes);
            Y.use('event', 'moodle-core-event', function(Y) {
                // Trigger it the JQuery way.
                $(document).trigger(M.core.event.FILTER_CONTENT_UPDATED, [nodes]);

                // Create a YUI NodeList from our JQuery Object.
                var yuiNodes = new Y.NodeList(nodes.get());

                // And again for YUI.
                Y.fire(M.core.event.FILTER_CONTENT_UPDATED, {nodes: yuiNodes});
            });
        },

        /**
         * Trigger an event using both JQuery and YUI
         *
         * @method notifyFormSubmittedAjax
         * @param {DOMElement} form
         * @param {boolean} skipValidation Submit the form without validation. E.g. "Cancel".
         */
        notifyFormSubmitAjax: function(form, skipValidation) {

            // Argument is optional.
            skipValidation = skipValidation || false;

            Y.use('event', 'moodle-core-event', function(Y) {
                if (skipValidation) {
                    window.skipClientValidation = true;
                }
                // Trigger it the JQuery way.
                $(form).trigger(M.core.event.FORM_SUBMIT_AJAX);

                // And again for YUI.
                Y.one(form).fire(M.core.event.FORM_SUBMIT_AJAX, {currentTarget: Y.one(form)});

                if (skipValidation) {
                    window.skipClientValidation = false;
                }
            });
        },

        /**
         * Trigger an event using both JQuery and YUI
         * This event alerts the world that the editor has restored some content.
         *
         * @method notifyEditorContentRestored
         */
        notifyEditorContentRestored: function() {
            Y.use('event', 'moodle-core-event', function(Y) {
                // Trigger it the JQuery way.
                $(document).trigger(M.core.event.EDITOR_CONTENT_RESTORED);

                // And again for YUI.
                Y.fire(M.core.event.EDITOR_CONTENT_RESTORED);
            });
        },
    };
});
