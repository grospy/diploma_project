<?php
//

/**
 * Spellchecker settings.
 *
 * @package   tinymce_spellchecker
 * @copyright 2012 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $options = array(
        ''=>get_string('none'),
        'PSpell'=>'PSpell',
        'PSpellShell'=>'PSpellShell');
    $settings->add(new admin_setting_configselect('tinymce_spellchecker/spellengine',
        get_string('spellengine', 'admin'), '', '', $options));
    $settings->add(new admin_setting_configtextarea('tinymce_spellchecker/spelllanguagelist',
        get_string('spelllanguagelist', 'admin'), '',
        '+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,' .
            'Portuguese=pt,Spanish=es,Swedish=sv', PARAM_RAW));
}
