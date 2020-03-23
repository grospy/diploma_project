<?php
//

/**
 * Atto text editor emoji picker plugin lib.
 *
 * @package    atto_emojipicker
 * @copyright  2019 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Initialise the strings required for JS.
 *
 * @return void
 */
function atto_emojipicker_strings_for_js() {
    global $PAGE;
    $PAGE->requires->strings_for_js(['emojipicker'], 'atto_emojipicker');
}

/**
 * Sends the parameters to JS module.
 *
 * @return array
 */
function atto_emojipicker_params_for_js() {
    global $CFG;

    return [
        'disabled' => empty($CFG->allowemojipicker) ? true : false
    ];
}
