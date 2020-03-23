//

/**
 * Grading panel for gradingform_guide.
 *
 * @module     gradingform_guide/grades/grader/gradingpanel
 * @package    gradingform_guide
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {call as fetchMany} from 'core/ajax';
import {normaliseResult} from 'core_grades/grades/grader/gradingpanel/normalise';
import {compareData} from 'core_grades/grades/grader/gradingpanel/comparison';

// Note: We use jQuery.serializer here until we can rewrite Ajax to use XHR.send()
import jQuery from 'jquery';

/**
 * For a given component, contextid, itemname & gradeduserid we can fetch the currently assigned grade.
 *
 * @param {String} component
 * @param {Number} contextid
 * @param {String} itemname
 * @param {Number} gradeduserid
 *
 * @returns {Promise}
 */
export const fetchCurrentGrade = (component, contextid, itemname, gradeduserid) => {
    return fetchMany([{
        methodname: `gradingform_guide_grader_gradingpanel_fetch`,
        args: {
            component,
            contextid,
            itemname,
            gradeduserid,
        },
    }])[0];
};

/**
 * For a given component, contextid, itemname & gradeduserid we can store the currently assigned grade in a given form.
 *
 * @param {String} component
 * @param {Number} contextid
 * @param {String} itemname
 * @param {Number} gradeduserid
 * @param {Boolean} notifyUser
 * @param {HTMLElement} rootNode
 *
 * @returns {Promise}
 */
export const storeCurrentGrade = async(component, contextid, itemname, gradeduserid, notifyUser, rootNode) => {
    const form = rootNode.querySelector('form');

    if (compareData(form) === true) {
        return normaliseResult(await fetchMany([{
            methodname: `gradingform_guide_grader_gradingpanel_store`,
            args: {
                component,
                contextid,
                itemname,
                gradeduserid,
                notifyuser: notifyUser,
                formdata: jQuery(form).serialize(),
            },
        }])[0]);
    } else {
        return '';
    }
};
