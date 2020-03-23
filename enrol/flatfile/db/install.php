<?php
//

/**
 * Flatfile enrolment plugin installation.
 *
 * @package    enrol_flatfile
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_enrol_flatfile_install() {
    global $CFG, $DB;

    // Flatfile role mappings are empty by default now.
    $roles = get_all_roles();
    foreach ($roles as $role) {
        set_config('map_'.$role->id, $role->shortname, 'enrol_flatfile');
    }
}
