//

/**
 * Grading panel for simple direct grading.
 *
 * @module     core_grades/grades/grader/gradingpanel/point
 * @package    core_grades
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {saveGrade, fetchGrade} from './repository';
import {compareData} from 'core_grades/grades/grader/gradingpanel/comparison';
// Note: We use jQuery.serializer here until we can rewrite Ajax to use XHR.send()
import jQuery from 'jquery';
import {invalidResult} from './normalise';

/**
 * Fetch the current grade for a user.
 *
 * @param {String} component
 * @param {Number} context
 * @param {String} itemname
 * @param {Number} userId
 * @param {Element} rootNode
 * @return {Object}
 */
export const fetchCurrentGrade = (...args) => fetchGrade('point')(...args);

/**
 * Store a new grade for a user.
 *
 * @param {String} component
 * @param {Number} context
 * @param {String} itemname
 * @param {Number} userId
 * @param {Boolean} notifyUser
 * @param {Element} rootNode
 *
 * @return {Object}
 */
export const storeCurrentGrade = async(component, context, itemname, userId, notifyUser, rootNode) => {
    const form = rootNode.querySelector('form');
    const grade = form.querySelector('input[name="grade"]');

    if (!grade.checkValidity() || !grade.value.trim()) {
        return invalidResult;
    }

    if (compareData(form) === true) {
        return await saveGrade('point')(component, context, itemname, userId, notifyUser, jQuery(form).serialize());
    } else {
        return '';
    }
};
