//

/**
 * AMD module for categories actions.
 *
 * @module     tool_dataprivacy/categoriesactions
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([
    'jquery',
    'core/ajax',
    'core/notification',
    'core/str',
    'core/modal_factory',
    'core/modal_events'],
function($, Ajax, Notification, Str, ModalFactory, ModalEvents) {

    /**
     * List of action selectors.
     *
     * @type {{DELETE: string}}
     */
    var ACTIONS = {
        DELETE: '[data-action="deletecategory"]',
    };

    /**
     * CategoriesActions class.
     */
    var CategoriesActions = function() {
        this.registerEvents();
    };

    /**
     * Register event listeners.
     */
    CategoriesActions.prototype.registerEvents = function() {
        $(ACTIONS.DELETE).click(function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var categoryname = $(this).data('name');
            var stringkeys = [
                {
                    key: 'deletecategory',
                    component: 'tool_dataprivacy'
                },
                {
                    key: 'deletecategorytext',
                    component: 'tool_dataprivacy',
                    param: categoryname
                },
                {
                    key: 'delete'
                }
            ];

            Str.get_strings(stringkeys).then(function(langStrings) {
                var title = langStrings[0];
                var confirmMessage = langStrings[1];
                var buttonText = langStrings[2];
                return ModalFactory.create({
                    title: title,
                    body: confirmMessage,
                    type: ModalFactory.types.SAVE_CANCEL
                }).then(function(modal) {
                    modal.setSaveButtonText(buttonText);

                    // Handle save event.
                    modal.getRoot().on(ModalEvents.save, function() {

                        var request = {
                            methodname: 'tool_dataprivacy_delete_category',
                            args: {'id': id}
                        };

                        Ajax.call([request])[0].done(function(data) {
                            if (data.result) {
                                $('tr[data-categoryid="' + id + '"]').remove();
                            } else {
                                Notification.addNotification({
                                    message: data.warnings[0].message,
                                    type: 'error'
                                });
                            }
                        }).fail(Notification.exception);
                    });

                    // Handle hidden event.
                    modal.getRoot().on(ModalEvents.hidden, function() {
                        // Destroy when hidden.
                        modal.destroy();
                    });

                    return modal;
                });
            }).done(function(modal) {
                modal.show();

            }).fail(Notification.exception);
        });
    };

    return /** @alias module:tool_dataprivacy/categoriesactions */ {
        // Public variables and functions.

        /**
         * Initialise the module.
         *
         * @method init
         * @return {CategoriesActions}
         */
        'init': function() {
            return new CategoriesActions();
        }
    };
});
