//

/**
 * Module to get the scale values.
 *
 * @package    tool_lp
 * @copyright  2016 Serge Gauthier
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/ajax'], function($, ajax) {
    var localCache = [];

    return /** @alias module:tool_lp/scalevalues */ {

        /**
         * Return a promise object that will be resolved into a string eventually (maybe immediately).
         *
         * @method get_values
         * @param {Number} scaleid The scale id
         * @return [] {Promise}
         */
        // eslint-disable-next-line camelcase
        get_values: function(scaleid) {

            var deferred = $.Deferred();

            if (typeof localCache[scaleid] === 'undefined') {
                ajax.call([{
                    methodname: 'core_competency_get_scale_values',
                    args: {scaleid: scaleid},
                    done: function(scaleinfo) {
                        localCache[scaleid] = scaleinfo;
                        deferred.resolve(scaleinfo);
                    },
                    fail: (deferred.reject)
                }]);
            } else {
                deferred.resolve(localCache[scaleid]);
            }

            return deferred.promise();
        }
    };
});
