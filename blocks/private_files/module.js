//

/**
 * Init private files treeview
 *
 * @package    block_private_files
 * @copyright  2009 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

M.block_private_files = {};

M.block_private_files.init_tree = function(Y, expand_all, htmlid) {
    Y.use('yui2-treeview', 'node-event-simulate', function(Y) {
        var tree = new Y.YUI2.widget.TreeView(htmlid);

        tree.subscribe("clickEvent", function(node, event) {
            // we want normal clicking which redirects to url
            return false;
        });

        tree.subscribe("enterKeyPressed", function(node) {
            // We want keyboard activation to trigger a click on the first link.
            Y.one(node.getContentEl()).one('a').simulate('click');
            return false;
        });

        if (expand_all) {
            tree.expandAll();
        }

        tree.render();
    });
};
