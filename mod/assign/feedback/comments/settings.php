<?php
//

/**
 * This file defines the admin settings for this plugin
 *
 * @package   assignfeedback_comments
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings->add(new admin_setting_configcheckbox('assignfeedback_comments/default',
                   new lang_string('default', 'assignfeedback_comments'),
                   new lang_string('default_help', 'assignfeedback_comments'), 1));

$setting = new admin_setting_configcheckbox('assignfeedback_comments/inline',
                   new lang_string('commentinlinedefault', 'assignfeedback_comments'),
                   new lang_string('commentinlinedefault_help', 'assignfeedback_comments'), 0);

$setting->set_advanced_flag_options(admin_setting_flag::ENABLED, false);
$setting->set_locked_flag_options(admin_setting_flag::ENABLED, false);

$settings->add($setting);
