<?php
//

/**
 * print the single-values of anonymous completeds
 *
 * @author Andreas Grabs
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package mod_feedback
 */

require_once("../../config.php");

// This file is no longer used, however it will remain here to redirect existing links to show_entries.php.
$url = new moodle_url('/mod/feedback/show_entries.php');
foreach ($_GET as $key => $value) {
    $url->param($key, $value);
}
redirect($url);
