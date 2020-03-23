<?php
//

defined('MOODLE_INTERNAL') || die();

/**
 * Installation for unoconv.
 *
 * @package   fileconverter_unoconv
 * @copyright 2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_fileconverter_unoconv_install() {
    global $CFG;

    $unoconvpresent = !empty($CFG->pathtounoconv);
    $unoconvpresent = $unoconvpresent && file_exists($CFG->pathtounoconv);
    $unoconvpresent = $unoconvpresent && !is_dir($CFG->pathtounoconv);
    $unoconvpresent = $unoconvpresent && file_is_executable($CFG->pathtounoconv);
    if ($unoconvpresent) {
        // Unoconv is currently configured correctly.
        // Enable it.
        $plugins = \core_plugin_manager::instance()->get_plugins_of_type('fileconverter');
        $plugins['unoconv']->set_enabled(true);
    }
}
