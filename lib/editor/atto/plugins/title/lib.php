<?php
//

/**
 * Atto text editor integration version file.
 *
 * @package    atto_title
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function atto_title_strings_for_js() {
    global $PAGE;

    $PAGE->requires->strings_for_js(array('h3',
                                          'h4',
                                          'h5',
                                          'pre',
                                          'p'), 'atto_title');
}

