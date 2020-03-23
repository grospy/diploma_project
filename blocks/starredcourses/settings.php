<?php
//

/**
 * Settings for the starredcourses block
 *
 * @package    block_starredcourses
 * @copyright  2019 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Display Course Categories on the starred courses block items.
    $settings->add(new admin_setting_configcheckbox(
        'block_starredcourses/displaycategories',
        get_string('displaycategories', 'block_starredcourses'),
        get_string('displaycategories_help', 'block_starredcourses'),
        1));
}
