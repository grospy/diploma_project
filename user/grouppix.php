<?php
//

/**
 * This function fetches group pictures from the data directory.
 *
 * Syntax:   pix.php/groupid/f1.jpg or pix.php/groupid/f2.jpg
 *     OR:   ?file=groupid/f1.jpg or ?file=groupid/f2.jpg
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */

// Disable moodle specific debug messages and any errors in output.
define('NO_DEBUG_DISPLAY', true);
define('NO_MOODLE_COOKIES', true); // Session not used here.

require_once('../config.php');
require_once($CFG->libdir.'/filelib.php');

$relativepath = get_file_argument();

$args = explode('/', trim($relativepath, '/'));

if (count($args) == 2) {
    $groupid  = (integer)$args[0];
    $image    = $args[1];
    $pathname = $CFG->dataroot.'/groups/'.$groupid.'/'.$image;
} else {
    $image    = 'f1.png';
    $pathname = $CFG->dirroot.'/pix/g/f1.png';
}

if (file_exists($pathname) and !is_dir($pathname)) {
    send_file($pathname, $image);
} else {
    header('HTTP/1.0 404 not found');
    print_error('filenotfound', 'error'); // This is not displayed on IIS??
}
