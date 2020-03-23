<?php
//

/**
 * Adds settings links to admin tree.
 *
 * @package tool_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if (\core_analytics\manager::is_analytics_enabled()) {
    $ADMIN->add('analytics', new admin_externalpage('analyticmodels', get_string('analyticmodels', 'tool_analytics'),
        "$CFG->wwwroot/$CFG->admin/tool/analytics/index.php", 'moodle/analytics:managemodels'));
}
