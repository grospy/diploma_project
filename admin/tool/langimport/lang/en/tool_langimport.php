<?php
//

/**
 * Strings for component 'tool_langimport', language 'en', branch 'MOODLE_22_STABLE'
 *
 * @package    tool
 * @subpackage langimport
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['downloadnotavailable'] = 'Unable to connect to the download server. It is not possible to install or update the language packs automatically. Please download the appropriate ZIP file(s) from <a href="{$a->src}">{$a->src}</a> and unzip them manually to your data directory <code>{$a->dest}</code>';
$string['install'] = 'Install selected language pack(s)';
$string['installedlangs'] = 'Installed language packs';
$string['langimport'] = 'Language import utility';
$string['langimportdisabled'] = 'Language import feature has been disabled. You have to update your language packs manually at the file-system level. Do not forget to purge string caches after you do so.';
$string['langpackinstalled'] = 'Language pack \'{$a}\' was successfully installed';
$string['langpackinstalledevent'] = 'Language pack installed';
$string['langpackremoved'] = 'Language pack \'{$a}\' was uninstalled';
$string['langpacknotremoved'] = 'An error has occurred; language pack \'{$a}\' is not completely uninstalled. Please check file permissions.';
$string['langpackremovedevent'] = 'Language pack uninstalled';
$string['langpackupdateskipped'] = 'Update of \'{$a}\' language pack skipped';
$string['langpackuptodate'] = 'Language pack \'{$a}\' is up-to-date';
$string['langpackupdated'] = 'Language pack \'{$a}\' was successfully updated';
$string['langpackupdatedevent'] = 'Language pack updated';
$string['langunsupported'] = '<p>Your server does not seem to fully support the following languages:</p><ul>{$a->missinglocales}</ul><p>Instead, the global locale ({$a->globallocale}) will be used to format certain strings such as dates or numbers.</p>';
$string['langupdatecomplete'] = 'Language pack update completed';
$string['missingcfglangotherroot'] = 'Missing configuration value $CFG->langotherroot';
$string['missinglangparent'] = 'Missing parent language <em>{$a->parent}</em> of <em>{$a->lang}</em>.';
$string['noenglishuninstall'] = 'The English language pack cannot be uninstalled.';
$string['nolangupdateneeded'] = 'All your language packs are up to date, no update is needed';
$string['pluginname'] = 'Language packs';
$string['purgestringcaches'] = 'Purge string caches';
$string['selectlangs'] = 'Select languages to uninstall';
$string['uninstall'] = 'Uninstall selected language pack(s)';
$string['uninstallconfirm'] = 'You are about to completely uninstall these language packs: <strong>{$a}</strong>. Are you sure?';
$string['updatelangs'] = 'Update all installed language packs';
$string['privacy:metadata'] = 'The Language packs plugin does not store any personal data.';
