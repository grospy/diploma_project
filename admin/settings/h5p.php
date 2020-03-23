<?php
//

/**
 * H5P settings link.
 *
 * @package    core_h5p
 * @copyright  2019 Amaia Anabitarte <amaia@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Settings page.
$ADMIN->add('h5p', new admin_externalpage('h5psettings', get_string('h5pmanage', 'core_h5p'),
    new moodle_url('/h5p/libraries.php'), ['moodle/site:config', 'moodle/h5p:updatelibraries']));
