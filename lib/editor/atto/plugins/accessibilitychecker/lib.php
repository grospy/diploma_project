<?php
//

/**
 * Atto text editor integration version file.
 *
 * @package    atto_accessibilitychecker
 * @copyright  2014 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Initialise this plugin
 * @param string $elementid
 */
function atto_accessibilitychecker_strings_for_js() {
    global $PAGE;

    $PAGE->requires->strings_for_js(array('nowarnings',
                                    'report',
                                    'imagesmissingalt',
                                    'needsmorecontrast',
                                    'needsmoreheadings',
                                    'tableswithmergedcells',
                                    'tablesmissingcaption',
                                    'emptytext',
                                    'entiredocument',
                                    'tablesmissingheaders'),
                                    'atto_accessibilitychecker');
}

