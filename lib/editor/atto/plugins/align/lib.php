<?php
//

/**
 * Atto text editor align plugin lib.
 *
 * @package    atto_align
 * @copyright  2014 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Initialise the strings required for JS.
 *
 * @return void
 */
function atto_align_strings_for_js() {
    global $PAGE;
    $PAGE->requires->strings_for_js(array('center', 'leftalign', 'rightalign'), 'atto_align');
}
