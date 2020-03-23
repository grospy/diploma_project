//

/**
 * Additional javascript for the Workshop module form.
 *
 * @module      mod_workshop/modform
 * @copyright   The Open University 2018
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery'], function($) {

    var submissionTypes = {
        text: {
            available: null,
            required: null,
            requiredHidden: null
        },
        file: {
            available: null,
            required: null,
            requiredHidden: null
        }
    };

    /**
     * Determine whether one of the submission types has been marked as not available.
     *
     * If it has been marked not available, clear and disable its required checkbox.  Then determine if the other submission
     * type is available, and if it is, check and disable its required checkbox.
     *
     * @param {Object} checkUnavailable
     * @param {Object} checkAvailable
     */
    function checkAvailability(checkUnavailable, checkAvailable) {
        if (!checkUnavailable.available.prop('checked')) {
            checkUnavailable.required.prop('disabled', true);
            checkUnavailable.required.prop('checked', false);
            if (checkAvailable.available.prop('checked')) {
                checkAvailable.required.prop('disabled', true);
                checkAvailable.required.prop('checked', true);
                // Also set the checkbox's hidden field to 1 so a 'required' value is submitted for the submission type.
                checkAvailable.requiredHidden.val(1);
            }
        }
    }

    /**
     * Enable the submission type's required checkbox and uncheck it.
     *
     * @param {Object} submissionType
     */
    function enableRequired(submissionType) {
        submissionType.required.prop('disabled', false);
        submissionType.required.prop('checked', false);
        submissionType.requiredHidden.val(0);
    }

    /**
     * Check which submission types have been marked as available, and disable required checkboxes as necessary.
     */
    function submissionTypeChanged() {
        checkAvailability(submissionTypes.file, submissionTypes.text);
        checkAvailability(submissionTypes.text, submissionTypes.file);
        if (submissionTypes.text.available.prop('checked') && submissionTypes.file.available.prop('checked')) {
            enableRequired(submissionTypes.text);
            enableRequired(submissionTypes.file);
        }
    }

    return /** @alias module:mod_workshop/modform */ {
        /**
         * Find all the required fields, set up event listeners, and set the initial state of required checkboxes.
         */
        init: function() {
            submissionTypes.text.available = $('#id_submissiontypetextavailable');
            submissionTypes.text.required = $('#id_submissiontypetextrequired');
            submissionTypes.text.requiredHidden = $('input[name="submissiontypetextrequired"][type="hidden"]');
            submissionTypes.file.available = $('#id_submissiontypefileavailable');
            submissionTypes.file.required = $('#id_submissiontypefilerequired');
            submissionTypes.file.requiredHidden = $('input[name="submissiontypefilerequired"][type="hidden"]');
            submissionTypes.text.available.on('change', submissionTypeChanged);
            submissionTypes.file.available.on('change', submissionTypeChanged);
            submissionTypeChanged();
        }
    };
});
