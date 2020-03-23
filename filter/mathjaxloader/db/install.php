<?php
//

/**
 * Mathjax filter post install hook
 *
 * @package    filter
 * @subpackage mathjaxloader
 * @copyright  2014 onwards Andrew Davis (andyjdavis)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_filter_mathjaxloader_install() {
    global $CFG;
    require_once("$CFG->libdir/filterlib.php");

    filter_set_global_state('mathjaxloader', TEXTFILTER_ON, -1);
}
