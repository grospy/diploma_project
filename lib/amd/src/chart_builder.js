//

/**
 * Chart builder.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery'], function($) {

    /**
     * Chart builder.
     *
     * @exports core/chart_builder
     */
    var module = {

        /**
         * Make a chart instance.
         *
         * This takes data, most likely generated in PHP, and creates a chart instance from it
         * deferring most of the logic to {@link module:core/chart_base.create}.
         *
         * @param {Object} data The data.
         * @return {Promise} A promise resolved with the chart instance.
         */
        make: function(data) {
            var deferred = $.Deferred();
            require(['core/chart_' + data.type], function(Klass) {
                var instance = Klass.prototype.create(Klass, data);
                deferred.resolve(instance);
            });
            return deferred.promise();
        }
    };

    return module;

});
