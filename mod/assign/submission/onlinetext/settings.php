<?php
//

/**
 * This file defines the admin settings for this plugin
 *
 * @package   assignsubmission_onlinetext
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings->add(new admin_setting_configcheckbox('assignsubmission_onlinetext/default',
                   new lang_string('default', 'assignsubmission_onlinetext'),
                   new lang_string('default_help', 'assignsubmission_onlinetext'), 0));

