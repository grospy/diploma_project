<?php
//

/**
 * Display H5P filter settings
 *
 * @package    filter_displayh5p
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtextarea(
        'filter_displayh5p/allowedsources',
            get_string('allowedsourceslist',
            'filter_displayh5p'),
            get_string('allowedsourceslistdesc', 'filter_displayh5p'),
            "https://h5p.org/h5p/embed/[id]"));
}
