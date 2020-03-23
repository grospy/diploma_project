<?php
//

/**
 * Atto text editor align plugin lib.
 *
 * @package    atto_align
 * @copyright  2014 Jason Fowler
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Initialise the strings required for JS.
 *
 * @return void
 */
function atto_indent_strings_for_js() {
    global $PAGE;
    $PAGE->requires->strings_for_js(array('indent', 'outdent'), 'atto_indent');
}
