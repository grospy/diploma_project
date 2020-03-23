//

/**
 * Module to add categories.
 *
 * @module     tool_dataprivacy/add_category
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/str', 'core/ajax', 'core/notification', 'core/modal_factory', 'core/modal_events', 'core/fragment'],
    function($, Str, Ajax, Notification, ModalFactory, ModalEvents, Fragment) {

        var SELECTORS = {
            CATEGORY_LINK: '[data-add-element="category"]',
        };

        var AddCategory = function(contextId) {
            this.contextId = contextId;

            var stringKeys = [
                {
                    key: 'addcategory',
                    component: 'tool_dataprivacy'
                },
                {
                    key: 'save',
                    component: 'admin'
                }
            ];
            this.strings = Str.get_strings(stringKeys);

            this.registerEventListeners();
        };

        /**
         * @var {int} contextId
         * @private
         */
        AddCategory.prototype.contextId = 0;

        /**
         * @var {Promise}
         * @private
         */
        AddCategory.prototype.strings = 0;

        AddCategory.prototype.registerEventListeners = function() {

            var trigger = $(SELECTORS.CATEGORY_LINK);
            trigger.on('click', function() {
                return this.strings.then(function(strings) {
                    ModalFactory.create({
                        type: ModalFactory.types.SAVE_CANCEL,
                        title: strings[0],
                        body: '',
                    }, trigger).done(function(modal) {
                        this.setupFormModal(modal, strings[1]);
                    }.bind(this));
                }.bind(this))
                .fail(Notification.exception);
            }.bind(this));

        };

        /**
         * @method getBody
         * @param {Object} formdata
         * @private
         * @return {Promise}
         */
        AddCategory.prototype.getBody = function(formdata) {

            var params = null;
            if (typeof formdata !== "undefined") {
                params = {jsonformdata: JSON.stringify(formdata)};
            }
            // Get the content of the modal.
            return Fragment.loadFragment('tool_dataprivacy', 'addcategory_form', this.contextId, params);
        };

        AddCategory.prototype.setupFormModal = function(modal, saveText) {
            modal.setLarge();

            modal.setSaveButtonText(saveText);

            // We want to reset the form every time it is opened.
            modal.getRoot().on(ModalEvents.hidden, this.destroy.bind(this));

            modal.setBody(this.getBody());

            // We catch the modal save event, and use it to submit the form inside the modal.
            // Triggering a form submission will give JS validation scripts a chance to check for errors.
            modal.getRoot().on(ModalEvents.save, this.submitForm.bind(this));
            // We also catch the form submit event and use it to submit the form with ajax.
            modal.getRoot().on('submit', 'form', this.submitFormAjax.bind(this));

            this.modal = modal;

            modal.show();
        };

        /**
         * This triggers a form submission, so that any mform elements can do final tricks before the form submission is processed.
         *
         * @method submitForm
         * @param {Event} e Form submission event.
         * @private
         */
        AddCategory.prototype.submitForm = function(e) {
            e.preventDefault();
            this.modal.getRoot().find('form').submit();
        };

        AddCategory.prototype.submitFormAjax = function(e) {
            // We don't want to do a real form submission.
            e.preventDefault();

            // Convert all the form elements values to a serialised string.
            var formData = this.modal.getRoot().find('form').serialize();

            Ajax.call([{
                methodname: 'tool_dataprivacy_create_category_form',
                args: {jsonformdata: JSON.stringify(formData)},
                done: function(data) {
                    if (data.validationerrors) {
                        this.modal.setBody(this.getBody(formData));
                    } else {
                        this.close();
                    }
                }.bind(this),
                fail: Notification.exception
            }]);
        };

        AddCategory.prototype.close = function() {
            this.destroy();
            document.location.reload();
        };

        AddCategory.prototype.destroy = function() {
            Y.use('moodle-core-formchangechecker', function() {
                M.core_formchangechecker.reset_form_dirty_state();
            });
            this.modal.destroy();
        };

        AddCategory.prototype.removeListeners = function() {
            $(SELECTORS.CATEGORY_LINK).off('click');
        };

        return /** @alias module:tool_dataprivacy/add_category */ {
            getInstance: function(contextId) {
                return new AddCategory(contextId);
            }
        };
    }
);

