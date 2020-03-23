<?php
//

/**
 * Quiz results block installation.
 *
 * @package    block_quiz_results
 * @copyright  2015 Dan Poltawski <dan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_block_quiz_results_install() {
    global $DB;

    // Disable quiz_results on new installs (its now just a stub).
    $DB->set_field('block', 'visible', 0, array('name' => 'quiz_results'));
}

