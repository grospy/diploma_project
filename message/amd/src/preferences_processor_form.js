//

/**
 * Manages the processor form on the message preferences page.
 *
 * @module     core_message/preferences_processor_form
 * @class      preferences_processor_form
 * @package    message
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/ajax', 'core/notification'],
        function($, Ajax, Notification) {
    /**
     * Constructor for the ProcessorForm.
     *
     * @param {object} element jQuery object root element of the preference
     */
    var ProcessorForm = function(element) {
        this.root = $(element);
        this.userId = this.root.attr('data-user-id');
        this.name = this.root.attr('data-processor-name');

        this.root.find('form').on('submit', function(e) {
            e.preventDefault();
            this.save().done(function() {
                $(element).trigger('mpp:formsubmitted');
            });
        }.bind(this));
    };

    /**
     * Flag the processor as loading.
     *
     * @method startLoading
     */
    ProcessorForm.prototype.startLoading = function() {
        this.root.addClass('loading');
    };

    /**
     * Remove the loading flag for this processor.
     *
     * @method stopLoading
     */
    ProcessorForm.prototype.stopLoading = function() {
        this.root.removeClass('loading');
    };

    /**
     * Check if this processor is loading.
     *
     * @method isLoading
     * @return {bool}
     */
    ProcessorForm.prototype.isLoading = function() {
        return this.root.hasClass('loading');
    };

    /**
     * Persist the processor configuration.
     *
     * @method save
     * @return {object} jQuery promise
     */
    ProcessorForm.prototype.save = function() {
        if (this.isLoading()) {
            return $.Deferred();
        }

        this.startLoading();

        var data = this.root.find('form').serializeArray();
        var request = {
            methodname: 'core_message_message_processor_config_form',
            args: {
                userid: this.userId,
                name: this.name,
                formvalues: data,
            }
        };

        return Ajax.call([request])[0]
            .fail(Notification.exception)
            .always(function() {
                this.stopLoading();
            }.bind(this));
    };

    return ProcessorForm;
});
