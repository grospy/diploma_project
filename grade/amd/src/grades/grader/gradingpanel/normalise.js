//

/**
 * Error handling and normalisation of provided data.
 *
 * @module     core_grades/grades/grader/gradingpanel/normalise
 * @package    core_grades
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Normalise a resultset for consumption by the grader.
 *
 * @param {Object} result The result returned from a grading web service
 * @return {Object}
 */
export const normaliseResult = result => {
    return {
        result,
        failed: !!result.warnings.length,
        success: !result.warnings.length,
        error: null,
    };
};

/**
 * Return the resultset used to describe an invalid result.
 *
 * @return {Object}
 */
export const invalidResult = () => {
    return {
        success: false,
        failed: false,
        result: {},
        error: null,
    };
};

/**
 * Return the resultset used to describe a failed update.
 *
 * @param {Object} error
 * @return {Object}
 */
export const failedUpdate = error => {
    return {
        success: false,
        failed: true,
        result: {},
        error,
    };
};
