<?php
//

/**
 * Filter post install hook
 *
 * @package    filter_activitynames
 * @copyright  2012 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_filter_activitynames_install() {
    global $CFG;
    require_once("$CFG->libdir/filterlib.php");

    filter_set_global_state('activitynames', TEXTFILTER_ON, 1);
}

