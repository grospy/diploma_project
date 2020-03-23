<?php
//

/**
 * Textarea profile field define.
 *
 * @package   profilefield_textarea
 * @copyright  2007 onwards Shane Elliot {@link http://pukunui.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class profile_define_textarea.
 *
 * @copyright  2007 onwards Shane Elliot {@link http://pukunui.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class profile_define_textarea extends profile_define_base {

    /**
     * Add elements for creating/editing a textarea profile field.
     * @param moodleform $form
     */
    public function define_form_specific($form) {
        // Default data.
        $form->addElement('editor', 'defaultdata', get_string('profiledefaultdata', 'admin'));
        $form->setType('defaultdata', PARAM_RAW); // We have to trust person with capability to edit this default description.
    }

    /**
     * Returns an array of editors used when defining this type of profile field.
     * @return array
     */
    public function define_editors() {
        return array('defaultdata');
    }
}