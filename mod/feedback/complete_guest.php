<?php
//

/**
 * prints the form so an anonymous user can fill out the feedback on the mainsite
 *
 * @author Andreas Grabs
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package mod_feedback
 */

require_once("../../config.php");

// This file is no longer used, however it will remain here to redirect existing links to complete.php.
$url = new moodle_url('/mod/feedback/complete.php');
foreach ($_GET as $key => $value) {
    $url->param($key, $value);
}
redirect($url);
