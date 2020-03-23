<?php
//

/**
 * Checkbox profile field
 *
 * @package   profilefield_checkbox
 * @copyright  2008 onwards Shane Elliot {@link http://pukunui.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class profile_define_checkbox
 * @copyright  2008 onwards Shane Elliot {@link http://pukunui.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class profile_define_checkbox extends profile_define_base {

    /**
     * Add elements for creating/editing a checkbox profile field.
     *
     * @param moodleform $form
     */
    public function define_form_specific($form) {
        // Select whether or not this should be checked by default.
        $form->addElement('selectyesno', 'defaultdata', get_string('profiledefaultchecked', 'admin'));
        $form->setDefault('defaultdata', 0); // Defaults to 'no'.
        $form->setType('defaultdata', PARAM_BOOL);
    }
}


