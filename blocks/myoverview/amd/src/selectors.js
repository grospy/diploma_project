//

/**
 * Javascript to initialise the selectors for the myoverview block.
 *
 * @package    block_myoverview
 * @copyright  2018 Peter Dias <peter@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define([], function() {
    return {
        courseView: {
            region: '[data-region="courses-view"]',
            regionContent: '[data-region="course-view-content"]'
        }
    };
});
