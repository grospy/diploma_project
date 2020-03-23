<?php
//

/**
 * Settings for format_singleactivity
 *
 * @package    format_singleactivity
 * @copyright  2012 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
require_once($CFG->dirroot. '/course/format/singleactivity/settingslib.php');

if ($ADMIN->fulltree) {
    $settings->add(new format_singleactivity_admin_setting_activitytype('format_singleactivity/activitytype',
            new lang_string('defactivitytype', 'format_singleactivity'),
            new lang_string('defactivitytypedesc', 'format_singleactivity'),
            'forum', null));
}
