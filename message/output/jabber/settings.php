<?php
//

/**
 * Jabber configuration page
 *
 * @package    message_jabber
 * @copyright  2011 Lancaster University Network Services Limited
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext('jabberhost', get_string('jabberhost', 'message_jabber'), get_string('configjabberhost', 'message_jabber'), '', PARAM_RAW));
    $settings->add(new admin_setting_configtext('jabberserver', get_string('jabberserver', 'message_jabber'), get_string('configjabberserver', 'message_jabber'), '', PARAM_RAW));
    $settings->add(new admin_setting_configtext('jabberusername', get_string('jabberusername', 'message_jabber'), get_string('configjabberusername', 'message_jabber'), '', PARAM_RAW));
    $settings->add(new admin_setting_configpasswordunmask('jabberpassword', get_string('jabberpassword', 'message_jabber'), get_string('configjabberpassword', 'message_jabber'), ''));
    $settings->add(new admin_setting_configtext('jabberport', get_string('jabberport', 'message_jabber'), get_string('configjabberport', 'message_jabber'), 5222, PARAM_INT));
}
