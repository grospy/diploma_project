<?php

//

/**
 * Folder module admin settings and defaults
 *
 * @package   mod_folder
 * @copyright 2009 Petr Skoda  {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_configcheckbox('folder/showexpanded',
        get_string('showexpanded', 'folder'),
        get_string('showexpanded_help', 'folder'), 1));

    $settings->add(new admin_setting_configtext('folder/maxsizetodownload',
        get_string('maxsizetodownload', 'folder'),
        get_string('maxsizetodownload_help', 'folder'), '', PARAM_INT));
}
