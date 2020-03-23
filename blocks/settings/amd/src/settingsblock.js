//

/**
 * Load the settings block tree javscript
 *
 * @module     block_settings/settingsblock
 * @package    core
 * @copyright  2015 John Okely <john@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery', 'core/tree'], function($, Tree) {
    return {
        init: function(instanceid, siteAdminNodeId) {
            var adminTree = new Tree(".block_settings .block_tree");
            if (siteAdminNodeId) {
                var siteAdminNode = adminTree.treeRoot.find('#' + siteAdminNodeId);
                var siteAdminLink = siteAdminNode.children('a').first();
                siteAdminLink.replaceWith('<span tabindex="0">' + siteAdminLink.html() + '</span>');
            }
            adminTree.finishExpandingGroup = function(item) {
                Tree.prototype.finishExpandingGroup.call(this, item);
                Y.use('moodle-core-event', function() {
                    Y.Global.fire(M.core.globalEvents.BLOCK_CONTENT_UPDATED, {
                        instanceid: instanceid
                    });
                });
            };
            adminTree.collapseGroup = function(item) {
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
