<?php
//

/**
 * Links and settings
 *
 * This file contains links and settings used by tool_lpimportcsv
 *
 * @package    tool_lpimportcsv
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

// Manage competency frameworks page.
$temp = new admin_externalpage(
    'toollpimportcsv',
    get_string('pluginname', 'tool_lpimportcsv'),
    new moodle_url('/admin/tool/lpimportcsv/index.php'),
    'moodle/competency:competencymanage'
);
$ADMIN->add('competencies', $temp);
// Export competency framework page.
$temp = new admin_externalpage(
    'toollpexportcsv',
    get_string('exportnavlink', 'tool_lpimportcsv'),
    new moodle_url('/admin/tool/lpimportcsv/export.php'),
    'moodle/competency:competencymanage'
);
$ADMIN->add('competencies', $temp);

// No report settings.
$settings = null;
