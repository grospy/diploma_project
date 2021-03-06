<?php
//

/**
 * Meta link enrolment plugin uninstallation.
 *
 * @package    enrol_meta
 * @copyright  2011 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_enrol_meta_uninstall() {
    global $CFG, $DB;

    $meta = enrol_get_plugin('meta');
    $rs = $DB->get_recordset('enrol', array('enrol'=>'meta'));
    foreach ($rs as $instance) {
        $meta->delete_instance($instance);
    }
    $rs->close();

    role_unassign_all(array('component'=>'enrol_meta'));

    return true;
}
