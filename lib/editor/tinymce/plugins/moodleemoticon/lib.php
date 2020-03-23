<?php
//

defined('MOODLE_INTERNAL') || die();

/**
 * Plugin for Moodle emoticons.
 *
 * @package   tinymce_moodleemoticon
 * @copyright 2012 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tinymce_moodleemoticon extends editor_tinymce_plugin {
    /** @var array list of buttons defined by this plugin */
    protected $buttons = array('moodleemoticon');

    protected function update_init_params(array &$params, context $context,
            array $options = null) {
        global $OUTPUT;

        if ($this->get_config('requireemoticon', 1)) {
            // If emoticon filter is disabled, do not add button.
            $filters = filter_get_active_in_context($context);
            if (!array_key_exists('emoticon', $filters)) {
                return;
            }
        }

        if ($row = $this->find_button($params, 'image')) {
            // Add button after 'image'.
            $this->add_button_after($params, $row, 'moodleemoticon', 'image');
        } else {
            // If 'image' is not found, add button in the end of the last row.
            $this->add_button_after($params, $this->count_button_rows($params), 'moodleemoticon');
        }

        // Add JS file, which uses default name.
        $this->add_js_plugin($params);

        // Extra params specifically for emoticon plugin.
        $manager = get_emoticon_manager();
        $emoticons = $manager->get_emoticons(true);
        $imgs = array();
        // See the TinyMCE plugin moodleemoticon for how the emoticon index is (ab)used.
        $index = 0;
        foreach ($emoticons as $emoticon) {
            $imgs[$emoticon->text] = $OUTPUT->render($manager->prepare_renderable_emoticon(
                    $emoticon, array('class' => 'emoticon emoticon-index-'.$index++)));
        }
        $params['moodleemoticon_emoticons'] = json_encode($imgs);
    }
}
