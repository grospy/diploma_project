<?php
//

/**
 * Post installation and migration code.
 *
 * @package    mod_lti
 * @copyright  2019 Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Stub for database installation.
 */
function xmldb_lti_install() {
    global $CFG, $OUTPUT;

    // Create the private key.
    require_once($CFG->dirroot . '/mod/lti/upgradelib.php');

    $warning = mod_lti_verify_private_key();
    if (!empty($warning)) {
        echo $OUTPUT->notification($warning, 'notifyproblem');
    }
}
