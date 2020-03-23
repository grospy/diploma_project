<?php
//

/**
 * This file defines the admin settings for this plugin
 *
 * @package   assignfeedback_offline
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings->add(new admin_setting_configcheckbox('assignfeedback_offline/default',
                   new lang_string('default', 'assignfeedback_offline'),
                   new lang_string('default_help', 'assignfeedback_offline'), 0));

