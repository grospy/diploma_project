<?php
//

/**
 * IMS CP module admin settings and defaults
 *
 * @package mod_imscp
 * @copyright  2009 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Modedit defaults.
    $settings->add(new admin_setting_heading('imscpmodeditdefaults',
                                             get_string('modeditdefaults', 'admin'),
                                             get_string('condifmodeditdefaults', 'admin')));
    $options = array('-1' => get_string('all'), '0' => get_string('no'),
                     '1' => '1', '2' => '2', '5' => '5', '10' => '10', '20' => '20');
    $settings->add(new admin_setting_configselect_with_advanced('imscp/keepold',
        get_string('keepold', 'imscp'), get_string('keepoldexplain', 'imscp'),
        array('value' => 1, 'adv' => false), $options));
}
