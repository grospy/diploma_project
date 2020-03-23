<?php
//

/**
 * Links and settings
 *
 * Contains settings used by insights report.
 *
 * @package    report_insights
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if (\core_analytics\manager::is_analytics_enabled()) {
    // Just a link to course report.
    $ADMIN->add('reports', new admin_externalpage('reportinsights', get_string('insights', 'report_insights'),
            $CFG->wwwroot . "/report/insights/insights.php?contextid=" . SYSCONTEXTID, 'moodle/analytics:listinsights'));

    // No report settings.
    $settings = null;
}
