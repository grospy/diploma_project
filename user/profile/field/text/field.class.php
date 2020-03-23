<?php
//

/**
 * Text profile field.
 *
 * @package    profilefield_text
 * @copyright  2007 onwards Shane Elliot {@link http://pukunui.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class profile_field_text
 *
 * @copyright  2007 onwards Shane Elliot {@link http://pukunui.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class profile_field_text extends profile_field_base {

    /**
     * Overwrite the base class to display the data for this field
     */
    public function display_data() {
        // Default formatting.
        $data = parent::display_data();

        // Are we creating a link?
        if (!empty($this->field->param4) and !empty($data)) {

            // Define the target.
            if (! empty($this->field->param5)) {
                $target = 'target="'.$this->field->param5.'"';
            } else {
                $target = '';
            }

            // Create the link.
            $data = '<a href="'.str_replace('$$', urlencode($data), $this->field->param4).'" '.$target.'>'.htmlspecialchars($data).'</a>';
        }

        return $data;
    }

    /**
     * Add fields for editing a text profile field.
     * @param moodleform $mform
     */
    public function edit_field_add($mform) {
        $size = $this->field->param1;
        $maxlength = $this->field->param2;
        $fieldtype = ($this->field->param3 == 1 ? 'password' : 'text');

        // Create the form field.
        $mform->addElement($fieldtype, $this->inputname, format_string($this->field->name), 'maxlength="'.$maxlength.'" size="'.$size.'" ');
        $mform->setType($this->inputname, PARAM_TEXT);
    }

    /**
     * Return the field type and null properties.
     * This will be used for validating the data submitted by a user.
     *
     * @return array the param type and null property
     * @since Moodle 3.2
     */
    public function get_field_properties() {
        return array(PARAM_TEXT, NULL_NOT_ALLOWED);
    }
}


