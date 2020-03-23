<?php
//

/**
 * Atto text editor integration version file.
 *
 * @package    atto_link
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Initialise this plugin
 * @param string $elementid
 */
function atto_link_strings_for_js() {
    global $PAGE;

    $PAGE->requires->strings_for_js(array('createlink',
                                          'unlink',
                                          'enterurl',
                                          'browserepositories',
                                          'openinnewwindow'),
                                    'atto_link');
}

