//

/**
 * A javascript module to handle user ajax actions.
 *
 * @module     block_recentlyaccesseditems/repository
 * @package    block_recentlyaccesseditems
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/ajax'], function(Ajax) {

    /**
     * Get the list of items that the user has most recently accessed.
     *
     * @method getRecentItems
     * @param {int} limit Only return this many results
     * @return {promise} Resolved with an array of items
     */
    var getRecentItems = function(limit) {
        var args = {};
        if (typeof limit !== 'undefined') {
            args.limit = limit;
        }
        var request = {
            methodname: 'block_recentlyaccesseditems_get_recent_items',
            args: args
        };
        return Ajax.call([request])[0];
    };
    return {
        getRecentItems: getRecentItems
    };
});