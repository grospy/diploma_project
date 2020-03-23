//

/**
 * Repository for simple direct grading panel.
 *
 * @module     core_grades/grades/grader/gradingpanel/repository
 * @package    core_grades
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import {call as fetchMany} from 'core/ajax';
import {normaliseResult} from './normalise';

export const fetchGrade = type => (component, contextid, itemname, gradeduserid) => {
    return fetchMany([{
        methodname: `core_grades_grader_gradingpanel_${type}_fetch`,
        args: {
            component,
            contextid,
            itemname,
            gradeduserid,
        },
    }])[0];
};

export const saveGrade = type => async(component, contextid, itemname, gradeduserid, notifyUser, formdata) => {
    return normaliseResult(await fetchMany([{
        methodname: `core_grades_grader_gradingpanel_${type}_store`,
        args: {
            component,
            contextid,
            itemname,
            gradeduserid,
            notifyuser: notifyUser,
            formdata,
        },
    }])[0]);
};
