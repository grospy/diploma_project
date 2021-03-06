<?php

//

/**
 * Resource module admin settings and defaults
 *
 * @package    mod_label
 * @copyright  2013 Davo Smith, Synergy Learning
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configcheckbox('label/dndmedia',
        get_string('dndmedia', 'mod_label'), get_string('configdndmedia', 'mod_label'), 1));

    $settings->add(new admin_setting_configtext('label/dndresizewidth',
        get_string('dndresizewidth', 'mod_label'), get_string('configdndresizewidth', 'mod_label'), 400, PARAM_INT, 6));

    $settings->add(new admin_setting_configtext('label/dndresizeheight',
        get_string('dndresizeheight', 'mod_label'), get_string('configdndresizeheight', 'mod_label'), 400, PARAM_INT, 6));
}
