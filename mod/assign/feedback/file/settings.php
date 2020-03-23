<?php
//

/**
 * This file defines the admin settings for this plugin
 *
 * @package   assignfeedback_file
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings->add(new admin_setting_configcheckbox('assignfeedback_file/default',
                   new lang_string('default', 'assignfeedback_file'),
                   new lang_string('default_help', 'assignfeedback_file'), 0));

