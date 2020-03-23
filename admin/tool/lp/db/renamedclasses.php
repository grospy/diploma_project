<?php
//

/**
 * This file contains renamed classes mappings.
 *
 * @package    tool_lp
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$renamedclasses = array(
    'tool_lp\\external\\cohort_summary_exporter' => 'core_cohort\\external\\cohort_summary_exporter',
    'tool_lp\\external\\course_module_summary_exporter' => 'core_course\\external\\course_module_summary_exporter',
    'tool_lp\\external\\course_summary_exporter' => 'core_course\\external\\course_summary_exporter',
    'tool_lp\\form\\persistent' => 'core\\form\\persistent',
);
