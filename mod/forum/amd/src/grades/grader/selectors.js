//

/**
 * This module will tie together all of the different calls the gradable module will make.
 *
 * @module     mod_forum/grades/grader/selectors
 * @package    mod_forum
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
export default {
    launch: '[data-grade-action="launch"]',
    gradableItem: '[data-gradable-itemtype]',
    gradableItems: {
        wholeForum: '[data-gradable-itemtype="forum"]',
    },
    expandConversation: '[data-action="view-context"]',
    posts: '[data-region="posts"]',
    viewGrade: '[data-grade-action="view"]',
};
