<?php
//

/**
 * Links and settings.
 *
 * This file contains links and settings used by tool_lp.
 *
 * @package    tool_lp
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$parentname = 'competencies';

// If the plugin is enabled we add the pages.
if (get_config('core_competency', 'enabled')) {

    // Manage competency frameworks page.
    $temp = new admin_externalpage(
        'toollpcompetencies',
        get_string('competencyframeworks', 'tool_lp'),
        new moodle_url('/admin/tool/lp/competencyframeworks.php', array('pagecontextid' => context_system::instance()->id)),
        array('moodle/competency:competencymanage')
    );
    $ADMIN->add($parentname, $temp);

    // Manage learning plans page.
    $temp = new admin_externalpage(
        'toollplearningplans',
        get_string('templates', 'tool_lp'),
        new moodle_url('/admin/tool/lp/learningplans.php', array('pagecontextid' => context_system::instance()->id)),
        array('moodle/competency:templatemanage')
    );
    $ADMIN->add($parentname, $temp);
}
