<?php
//

/**
 * Mediaplugin filter settings
 *
 * @package    filter_mediaplugin
 * @copyright  2016 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $url = new moodle_url('/admin/settings.php', ['section' => 'managemediaplayers']);
    $item = new admin_setting_heading('filter_mediaplugin/about',
        '',
        new lang_string('linktomedia', 'filter_mediaplugin', $url->out()));
    $settings->add($item);

}
