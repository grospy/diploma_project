<?php
//

/**
 * Display H5P functions to install and upgrade the filter.
 *
 * @package    filter_displayh5p
 * @copyright  2019 Carlos Escobedo <carlos@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/filterlib.php");

/**
 * Move up the displayh5p filter over urltolink and activitynames filters to works properly.
 * Also, displayh5p have to be enabled in order to display H5P content.
 *
 * @return void
 */
function filter_displayh5p_reorder() {

    // The filter enabled is mandatory to be able to display the H5P content.
    filter_set_global_state('displayh5p', TEXTFILTER_ON);

    $states = filter_get_global_states();
    $displayh5ppos = $states['displayh5p']->sortorder;
    $activitynamespos = 1;
    if (!empty($states['activitynames'])) {
        $activitynamespos = $states['activitynames']->sortorder;
    }
    $urltolinkpos = 1;
    if (!empty($states['urltolink'])) {
        $urltolinkpos = $states['urltolink']->sortorder;
    }
    $minpos = ($activitynamespos < $urltolinkpos) ? $activitynamespos : $urltolinkpos;
    while ($minpos < $displayh5ppos) {
        filter_set_global_state('displayh5p', TEXTFILTER_ON, -1);
        $displayh5ppos--;
    }
}
