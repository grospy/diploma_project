<?php
//

/**
 * Installation file for the Youtube repository.
 *
 * @package    repository_youtube
 * @category   repository
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This was supposed to be the installer script for the Youtube repository.
 *
 * However, since the Youtube repository is disabled in new Moodle installations from 3.0, and since we cannot
 * just delete this file, the function's contents has been replaced to just return true.
 * See https://tracker.moodle.org/browse/MDL-50572 for more details.
 *
 * @return bool Return true.
 */
function xmldb_repository_youtube_install() {
    return true;
}
