//

/**
 * Load the navigation tree javascript.
 *
 * @module     block_navigation/navblock
 * @package    core
 * @copyright  2015 John Okely <john@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/tree'], function($, Tree) {
    return {
        init: function(instanceid) {
            var navTree = new Tree(".block_navigation .block_tree");
            navTree.finishExpandingGroup = function(item) {
                Tree.prototype.finishExpandingGroup.call(this, item);
                Y.use('moodle-core-event', function() {
                    Y.Global.fire(M.core.globalEvents.BLOCK_CONTENT_UPDATED, {
                        instanceid: instanceid
                    });
                });
            };
            navTree.collapseGroup = function(item) {
                Tree.prototype.collapseGroup.call(this, item);
                Y.use('moodle-core-event', function() {
                    Y.Global.fire(M.core.globalEvents.BLOCK_CONTENT_UPDATED, {
                        instanceid: instanceid
                    });
                });
            };
        }
    };
});
