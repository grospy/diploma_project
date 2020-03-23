//

/**
 * Define all of the selectors we will be using on the grading interface.
 *
 * @module     mod_forum/local/grades/local/grader/selectors
 * @package    mod_forum
 * @copyright  2019 Mathew May <mathew.solutions>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * A small helper function to build queryable data selectors.
 * @param {String} name
 * @param {String} value
 * @return {string}
 */
const getDataSelector = (name, value) => {
    return `[data-${name}="${value}"]`;
};

export default {
    buttons: {
        toggleFullscreen: getDataSelector('action', 'togglefullscreen'),
        closeGrader: getDataSelector('action', 'closegrader'),
        saveGrade: getDataSelector('action', 'savegrade'),
        selectUser: getDataSelector('action', 'select-user'),
        toggleSearch: getDataSelector('action', 'toggle-search')
    },
    regions: {
        bodyContainer: getDataSelector('region', 'body-container'),
        moduleReplace: getDataSelector('region', 'module_content'),
        pickerRegion: getDataSelector('region', 'user_picker'),
        gradingPanel: getDataSelector('region', 'grade'),
        gradingPanelContainer: getDataSelector('region', 'grading-panel-container'),
        gradingPanelErrors: getDataSelector('region', 'grade-errors'),
        searchResultsContainer: getDataSelector('region', 'search-results-container'),
        statusContainer: getDataSelector('region', 'status-container'),
        userSearchContainer: getDataSelector('region', 'user-search-container'),
        userSearchInput: getDataSelector('region', 'user-search-input')
    },
    values: {
        sendStudentNotifications: '[data-region="notification"] input[type="radio"]:checked',
    }
};

