//

/**
 * Grading panel for simple direct grading.
 *
 * @module     core_grades/grades/grader/gradingpanel/scale
 * @package    core_grades
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {saveGrade, fetchGrade} from './repository';
import {compareData} from 'core_grades/grades/grader/gradingpanel/comparison';
// Note: We use jQuery.serializer here until we can rewrite Ajax to use XHR.send()
import jQuery from 'jquery';
import {invalidResult} from './normalise';

export const fetchCurrentGrade = (...args) => fetchGrade('scale')(...args);

export const storeCurrentGrade = (component, context, itemname, userId, notifyUser, rootNode) => {
    const form = rootNode.querySelector('form');
    const grade = form.querySelector('select[name="grade"]');

    if (!grade.checkValidity() || !grade.value.trim()) {
        return invalidResult;
    }

    if (compareData(form) === true) {
        return saveGrade('scale')(component, context, itemname, userId, notifyUser, jQuery(form).serialize());
    } else {
        return '';
    }
};
