<?php
//

defined('MOODLE_INTERNAL') || die();

/**
 * Plugin for Moodle media (audio/video) insertion dialog.
 *
 * @package   tinymce_moodlemedia
 * @copyright 2012 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tinymce_moodlemedia extends editor_tinymce_plugin {
    /** @var array list of buttons defined by this plugin */
    protected $buttons = array('moodlemedia');

    protected function update_init_params(array &$params, context $context,
            array $options = null) {

        // Add file picker callback.
        if (empty($options['legacy'])) {
            if (isset($options['maxfiles']) and $options['maxfiles'] != 0) {
                $params['file_browser_callback'] = "M.editor_tinymce.filepicker";
            }
        }

        if ($row = $this->find_button($params, 'moodleemoticon')) {
            // Add button after 'moodleemoticon' icon.
            $this->add_button_after($params, $row, 'moodlemedia', 'moodleemoticon');
        } else if ($row = $this->find_button($params, 'image')) {
            // Note: We know that the plugin emoticon button has already been added
            // if it is enabled because this plugin has higher sortorder.
            // Otherwise add after 'image'.
            $this->add_button_after($params, $row, 'moodlemedia', 'image');
        } else {
            // Add this button in the end of the first row (by default 'image' button should be in the first row).
            $this->add_button_after($params, 1, 'moodlemedia');
        }

        // Add JS file, which uses default name.
        $this->add_js_plugin($params);
    }

    protected function get_sort_order() {
        return 110;
    }
}
