//

/**
 * Module to update the displayed retention period.
 *
 * @module     tool_dataprivacy/effective_retention_period
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery'],
    function($) {

        var SELECTORS = {
            PURPOSE_SELECT: '#id_purposeid',
            RETENTION_FIELD: '#fitem_id_retention_current [data-fieldtype=static]',
        };

        /**
         * Constructor for the retention period display.
         *
         * @param {Array} purposeRetentionPeriods Associative array of purposeids with effective retention period at this context
         */
        var EffectiveRetentionPeriod = function(purposeRetentionPeriods) {
            this.purposeRetentionPeriods = purposeRetentionPeriods;
            this.registerEventListeners();
        };

        /**
         * Removes the current 'change' listeners.
         *
         * Useful when a new form is loaded.
         */
        var removeListeners = function() {
            $(SELECTORS.PURPOSE_SELECT).off('change');
        };

        /**
         * @var {Array} purposeRetentionPeriods
         * @private
         */
        EffectiveRetentionPeriod.prototype.purposeRetentionPeriods = [];

        /**
         * Add purpose change listeners.
         *
         * @method registerEventListeners
         */
        EffectiveRetentionPeriod.prototype.registerEventListeners = function() {

            $(SELECTORS.PURPOSE_SELECT).on('change', function(ev) {
                var selected = $(ev.currentTarget).val();
                var selectedPurpose = this.purposeRetentionPeriods[selected];
                $(SELECTORS.RETENTION_FIELD).text(selectedPurpose);
            }.bind(this));
        };

        return /** @alias module:tool_dataprivacy/effective_retention_period */ {
            init: function(purposeRetentionPeriods) {
                // Remove previously attached listeners.
                removeListeners();
                return new EffectiveRetentionPeriod(purposeRetentionPeriods);
            }
        };
    }
);

