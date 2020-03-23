<?php
//

/**
 * Emoticon integration settings.
 *
 * @package   tinymce_moodleemoticon
 * @copyright 2012 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configcheckbox('tinymce_moodleemoticon/requireemoticon',
        get_string('requireemoticon', 'tinymce_moodleemoticon'), get_string('requireemoticon_desc', 'tinymce_moodleemoticon'), 1));
}
