<?php
//

/**
 * Settings for assignfeedback PDF plugin
 *
 * @package   assignfeedback_editpdf
 * @copyright 2013 Davo Smith
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Enabled by default.
$settings->add(new admin_setting_configcheckbox('assignfeedback_editpdf/default',
                   new lang_string('default', 'assignfeedback_editpdf'),
                   new lang_string('default_help', 'assignfeedback_editpdf'), 1));

// Stamp files setting.
$name = 'assignfeedback_editpdf/stamps';
$title = get_string('stamps','assignfeedback_editpdf');
$description = get_string('stampsdesc', 'assignfeedback_editpdf');

$setting = new admin_setting_configstoredfile($name, $title, $description, 'stamps', 0,
    array('maxfiles' => 8, 'accepted_types' => array('image')));
$settings->add($setting);

// Ghostscript setting.
$systempathslink = new moodle_url('/admin/settings.php', array('section' => 'systempaths'));
$systempathlink = html_writer::link($systempathslink, get_string('systempaths', 'admin'));
$settings->add(new admin_setting_heading('pathtogs', get_string('pathtogs', 'admin'),
        get_string('pathtogspathdesc', 'assignfeedback_editpdf', $systempathlink)));

$url = new moodle_url('/mod/assign/feedback/editpdf/testgs.php');
$link = html_writer::link($url, get_string('testgs', 'assignfeedback_editpdf'));
$settings->add(new admin_setting_heading('testgs', '', $link));
