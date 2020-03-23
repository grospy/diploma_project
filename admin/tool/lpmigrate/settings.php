<?php
//

/**
 * Links and settings.
 *
 * @package    tool_lpmigrate
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

if (get_config('core_competency', 'enabled')) {

    $parentname = 'competencies';

    // Manage competency frameworks page.
    $temp = new admin_externalpage(
        'toollpmigrateframeworks',
        get_string('migrateframeworks', 'tool_lpmigrate'),
        new moodle_url('/admin/tool/lpmigrate/frameworks.php'),
        array('tool/lpmigrate:frameworksmigrate')
    );
    $ADMIN->add($parentname, $temp);

}
