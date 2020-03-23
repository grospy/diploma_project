<?php
//

/**
 * Redirects the user to the default grade report.
 *
 * @package   core_grades
 * @copyright 2015 Adrian Greeve <adrian@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->dirroot . '/user/lib.php');

require_login(null, false);
if (isguestuser()) {
    throw new require_login_exception('Guests are not allowed here.');
}
// Get the url to redirect to.
$url = user_mygrades_url();
// Redirect to that page.
redirect($url);
