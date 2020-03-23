//

/**
 * Grading panel functions.
 *
 * @module     mod_forum/local/grades/local/grader/gradingpnael
 * @package    mod_forum
 * @copyright  2019 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Get the grade panel setter and getter for the current component.
 * This function dynamically pulls the relevant gradingpanel JS file defined in the grading method.
 * We do this because we do not know until execution time what the grading type is and we do not want to import unused files.
 *
 * @param {String} component The component being graded
 * @param {Number} context The contextid of the thing being graded
 * @param {String} gradingComponent The thing providing the grading type
 * @param {String} gradingSubtype The subtype fo the grading component
 * @param {String} itemName The name of the thing being graded
 * @return {Object}
 */
export default async(component, context, gradingComponent, gradingSubtype, itemName) => {
    let gradingMethodHandler = `${gradingComponent}/grades/grader/gradingpanel`;
    if (gradingSubtype) {
        gradingMethodHandler += `/${gradingSubtype}`;
    }

    const GradingMethod = await import(gradingMethodHandler);

    return {
        getter: (userId) => GradingMethod.fetchCurrentGrade(component, context, itemName, userId),
        setter: (userId, notifyStudent, formData) => GradingMethod.storeCurrentGrade(
            component, context, itemName, userId, notifyStudent, formData),
    };
};

