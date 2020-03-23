//

/**
 * Grading panel frequently used comments selector.
 *
 * @module     gradingform_guide/grades/grader/gradingpanel/comments
 * @package    gradingform_guide
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import Selectors from './comments/selectors';

/**
 * Manage the frequently used comments in the Marking Guide form.
 *
 * @param {String} rootId
 */
export const init = (rootId) => {
    const rootNode = document.querySelector(`#${rootId}`);

    rootNode.addEventListener('click', (e) => {
        if (!e.target.matches(Selectors.frequentComment)) {
            return;
        }

        e.preventDefault();

        const clicked = e.target.closest(Selectors.frequentComment);
        const criterion = clicked.closest(Selectors.criterion);
        const remark = criterion.querySelector(Selectors.remark);

        if (!remark) {
            return;
        }

        // Either append the comment to an existing comment or set it as the comment.
        if (remark.value.trim()) {
            remark.value += `\n${clicked.innerHTML}`;
        } else {
            remark.value += clicked.innerHTML;
        }
    });
};
