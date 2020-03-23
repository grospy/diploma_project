<?php
//

/**
 * Spellchecker post install script.
 *
 * @package   tinymce_spellchecker
 * @copyright 2012 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_tinymce_spellchecker_install() {
    global $CFG, $DB;
    require_once(__DIR__.'/upgradelib.php');

    tinymce_spellchecker_migrate_settings();
}
