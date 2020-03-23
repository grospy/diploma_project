//

/**
 * A javascript module to enhance the override form.
 *
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import $ from 'jquery';

export const init = (formId, selectElementName) => {
    const form = document.getElementById(formId);
    const selectElement = form.querySelector(`[name="${selectElementName}"]`);

    $(selectElement).on('change', () => {
        const inputElement = document.createElement('input');
        inputElement.setAttribute('type', 'hidden');
        inputElement.setAttribute('name', 'userchange');
        inputElement.setAttribute('value', true);

        form.appendChild(inputElement);

        if (typeof M.core_formchangechecker !== 'undefined') {
            M.core_formchangechecker.reset_form_dirty_state();
        }

        form.submit();
    });
};