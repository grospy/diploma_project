//

/**
 * Javascript to initialise the myoverview block.
 *
 * @package    block_myoverview
 * @copyright  2018 Bas Brands <bas@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(
[
    'jquery',
    'block_myoverview/view',
    'block_myoverview/view_nav'
],
function(
    $,
    View,
    ViewNav
) {
    /**
     * Initialise all of the modules for the overview block.
     *
     * @param {object} root The root element for the overview block.
     */
    var init = function(root) {
        root = $(root);
        // Initialise the course navigation elements.
        ViewNav.init(root);
        // Initialise the courses view modules.
        View.init(root);
    };

    return {
        init: init
    };
});
