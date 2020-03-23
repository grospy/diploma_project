<?php
//

/**
 * Display H5P active by default
 *
 * @package    filter_displayh5p
 * @copyright  2019 Amaia Anabitarte <amaia@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Enable displayh5p filter by default to render H5P contents.
 * @throws coding_exception
 */
function xmldb_filter_displayh5p_install() {
    global $CFG;

    require_once($CFG->dirroot . '/filter/displayh5p/db/upgradelib.php');

    // We need to move up the displayh5p filter over urltolink and activitynames filters to works properly.
    filter_displayh5p_reorder();
}
