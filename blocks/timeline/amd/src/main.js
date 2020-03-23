//

/**
 * Javascript to initialise the timeline block.
 *
 * @copyright  2018 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(
[
    'jquery',
    'block_timeline/view_nav',
    'block_timeline/view'
],
function(
    $,
    ViewNav,
    View
) {

    var SELECTORS = {
        TIMELINE_VIEW: '[data-region="timeline-view"]'
    };

    /**
     * Initialise all of the modules for the timeline block.
     *
     * @param {object} root The root element for the timeline block.
     */
    var init = function(root) {
        root = $(root);
        var viewRoot = root.find(SELECTORS.TIMELINE_VIEW);

        // Initialise the timeline navigation elements.
        ViewNav.init(root, viewRoot);
        // Initialise the timeline view modules.
        View.init(viewRoot);
    };

    return {
        init: init
    };
});
