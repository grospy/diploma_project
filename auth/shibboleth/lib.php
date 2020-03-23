<?php
//

/**
 * This file contains the hooks for the Shibboleth authentication module.
 *
 * @package auth_shibboleth
 * @copyright 2018 Fabrice Ménard
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Serves the logo file settings.
 *
 * @param stdClass $course course object
 * @param stdClass $cm course module object
 * @param stdClass $context context object
 * @param string $filearea file area
 * @param array $args extra arguments
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 * @return bool false if file not found, does not return if found - justsend the file
 */
function auth_shibboleth_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {
    if ($context->contextlevel != CONTEXT_SYSTEM) {
        return false;
    }

    if ($filearea !== 'logo' ) {
        return false;
    }

    $itemid = 0;

    $filename = array_pop($args);
    if (!$args) {
        $filepath = '/';
    } else {
        $filepath = '/'.implode('/', $args).'/';
    }

    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'auth_shibboleth', $filearea, $itemid, $filepath, $filename);
    if (!$file) {
        return false;
    }

    send_stored_file($file, null, 0, $forcedownload, $options);
}
