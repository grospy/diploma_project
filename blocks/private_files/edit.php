<?php
//

/**
 * Manage files in folder in private area.
 *
 * This page is not used and now redirects to the page to manage the private files.
 *
 * @package   block_private_files
 * @copyright 2010 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

redirect(new moodle_url('/user/files.php'));
