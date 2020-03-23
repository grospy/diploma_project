//

/**
 * A helper to manage pendingJS checks.
 *
 * @module     core/pending
 * @package    core
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.6
 */
define(['jquery'], function($) {

   /**
    * Request a new pendingPromise to be resolved.
    *
    * When the action you are performing is complete, simply call resolve on the returned Promise.
    *
    * @param    {Object}    pendingKey An optional key value to use
    * @return   {Promise}
    */
    var request = function(pendingKey) {
        var pendingPromise = $.Deferred();

        pendingKey = pendingKey || {};
        M.util.js_pending(pendingKey);

        pendingPromise.then(function() {
            return M.util.js_complete(pendingKey);
        })
        .catch();

        return pendingPromise;
    };

    request.prototype.constructor = request;

    return request;
});
