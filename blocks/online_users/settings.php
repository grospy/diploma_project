<?php
//

/**
 * Online users block settings.
 *
 * @package    block_online_users
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext('block_online_users_timetosee', get_string('timetosee', 'block_online_users'),
                   get_string('configtimetosee', 'block_online_users'), 5, PARAM_INT));

    $settings->add(new admin_setting_configcheckbox('block_online_users_onlinestatushiding',
            get_string('onlinestatushiding', 'block_online_users'),
            get_string('onlinestatushiding_desc', 'block_online_users'), 1));
}

