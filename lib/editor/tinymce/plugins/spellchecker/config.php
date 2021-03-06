<?php
//

/**
 * Spellchecker configuration. (Has been rewritten for Moodle.)
 *
 * @package   tinymce_spellchecker
 * @copyright 2012 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../../../../config.php');

@error_reporting(E_ALL ^ E_NOTICE); // Hide notices even if Moodle is configured to show them.

// General settings
$engine = get_config('tinymce_spellchecker', 'spellengine');
if (!$engine or $engine === 'GoogleSpell') {
    $engine = 'PSpell';
}
$config['general.engine'] = $engine;

if ($config['general.engine'] === 'PSpell') {
    // PSpell settings
    $config['PSpell.mode'] = PSPELL_FAST;
    $config['PSpell.spelling'] = "";
    $config['PSpell.jargon'] = "";
    $config['PSpell.encoding'] = "";
} else if ($config['general.engine'] === 'PSpellShell') {
    // PSpellShell settings
    $config['PSpellShell.mode'] = PSPELL_FAST;
    $config['PSpellShell.aspell'] = $CFG->aspellpath;
    $config['PSpellShell.tmp'] = '/tmp';
}
