<?php
//

defined('MOODLE_INTERNAL') || die();

/**
 * Plugin for Moodle 'no link' button.
 *
 * @package   tinymce_moodlenolink
 * @copyright 2012 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tinymce_moodlenolink extends editor_tinymce_plugin {
    /** @var array list of buttons defined by this plugin */
    protected $buttons = array('moodlenolink');

    protected function update_init_params(array &$params, context $context,
            array $options = null) {

        if ($row = $this->find_button($params, 'unlink')) {
            // Add button after 'unlink'.
            $this->add_button_after($params, $row, 'moodlenolink', 'unlink');
        } else {
            // Add this button in the end of the first row (by default 'unlink' button should be in the first row).
            $this->add_button_after($params, 1, 'moodlenolink');
        }

        // Add JS file, which uses default name.
        $this->add_js_plugin($params);
    }
}
