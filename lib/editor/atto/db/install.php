<?php
//

/**
 * Atto upgrade script.
 *
 * @package    editor_atto
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Make the Atto the default editor for upgrades from 26.
 *
 * @return bool
 */
function xmldb_editor_atto_install() {
    global $CFG;

    // Make Atto the default.
    $currenteditors = $CFG->texteditors;
    $neweditors = array();

    $list = explode(',', $currenteditors);
    array_push($neweditors, 'atto');
    foreach ($list as $editor) {
        if ($editor != 'atto') {
            array_push($neweditors, $editor);
        }
    }

    set_config('texteditors', implode(',', $neweditors));

    return true;
}
