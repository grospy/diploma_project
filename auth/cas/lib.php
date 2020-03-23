<?php
//

/**
 * Authentication Plugin: CAS Authentication.
 *
 * Authentication using CAS (Central Authentication Server).
 *
 * @package     auth_cas
 * @copyright   2018 Fabrice Ménard <menard.fabrice@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Serves the logo file settings.
 *
 * @param   stdClass $course course object
 * @param   stdClass $cm course module object
 * @param   stdClass $context context object
 * @param   string $filearea file area
 * @param   array $args extra arguments
 * @param   bool $forcedownload whether or not force download
 * @param   array $options additional options affecting the file serving
 * @return  bool false|void
 */
function auth_cas_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    if ($context->contextlevel != CONTEXT_SYSTEM) {
        return false;
    }

    if ($filearea !== 'logo' ) {
        return false;
    }

    // Extract the filename / filepath from the $args array.
    $filename = array_pop($args);
    if (!$args) {
        $filepath = '/';
    } else {
        $filepath = '/' . implode('/', $args) . '/';
    }

    // Retrieve the file from the Files API.
    $itemid = 0;
    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'auth_cas', $filearea, $itemid, $filepath, $filename);
    if (!$file) {
        return false; // The file does not exist.
    }

    send_stored_file($file, null, 0, $forcedownload, $options);
}
