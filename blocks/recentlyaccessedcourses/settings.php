<?php
//

/**
 * Settings for the recentlyaccessedcourses block
 *
 * @package    block_recentlyaccessedcourses
 * @copyright  2019 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Display Course Categories on the recently accessed courses block items.
    $settings->add(new admin_setting_configcheckbox(
        'block_recentlyaccessedcourses/displaycategories',
        get_string('displaycategories', 'block_recentlyaccessedcourses'),
        get_string('displaycategories_help', 'block_recentlyaccessedcourses'),
        1));
}
