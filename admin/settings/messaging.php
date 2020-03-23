<?php
//

/**
 * Adds messaging related settings links for Messaging category to admin tree.
 *
 * @copyright 2019 Amaia Anabitarte <amaia@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $temp = new admin_settingpage('messages', new lang_string('messagingssettings', 'admin'));
    $temp->add(new admin_setting_configcheckbox('messaging',
        new lang_string('messaging', 'admin'),
        new lang_string('configmessaging', 'admin'),
        1));
    $temp->add(new admin_setting_configcheckbox('messagingallusers',
            new lang_string('messagingallusers', 'admin'),
            new lang_string('configmessagingallusers', 'admin'),
             0)
    );
    $temp->add(new admin_setting_configcheckbox('messagingdefaultpressenter',
            new lang_string('messagingdefaultpressenter', 'admin'),
            new lang_string('configmessagingdefaultpressenter', 'admin'),
            1)
    );
    $options = array(
        DAYSECS => new lang_string('secondstotime86400'),
        WEEKSECS => new lang_string('secondstotime604800'),
        2620800 => new lang_string('nummonths', 'moodle', 1),
        7862400 => new lang_string('nummonths', 'moodle', 3),
        15724800 => new lang_string('nummonths', 'moodle', 6),
        0 => new lang_string('never')
    );
    $temp->add(new admin_setting_configselect(
            'messagingdeletereadnotificationsdelay',
            new lang_string('messagingdeletereadnotificationsdelay', 'admin'),
            new lang_string('configmessagingdeletereadnotificationsdelay', 'admin'),
            604800,
            $options)
    );
    $temp->add(new admin_setting_configselect(
            'messagingdeleteallnotificationsdelay',
            new lang_string('messagingdeleteallnotificationsdelay', 'admin'),
            new lang_string('configmessagingdeleteallnotificationsdelay', 'admin'),
            2620800,
            $options)
    );
    $temp->add(new admin_setting_configcheckbox('messagingallowemailoverride',
        new lang_string('messagingallowemailoverride', 'admin'),
        new lang_string('configmessagingallowemailoverride', 'admin'),
        0));
    $ADMIN->add('messaging', $temp);
    $ADMIN->add('messaging', new admin_page_managemessageoutputs());

    // Notification outputs plugins.
    $plugins = core_plugin_manager::instance()->get_plugins_of_type('message');
    core_collator::asort_objects_by_property($plugins, 'displayname');
    foreach ($plugins as $plugin) {
        /** @var \core\plugininfo\message $plugin */
        $plugin->load_settings($ADMIN, 'messaging', $hassiteconfig);
    }
}
