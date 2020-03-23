<?php
//

/**
 * Prediction models tool frontend.
 *
 * @package tool_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

admin_externalpage_setup('analyticmodels', '', null, '', array('pagelayout' => 'report'));

$models = \core_analytics\manager::get_all_models();

echo $OUTPUT->header();

$templatable = new \tool_analytics\output\models_list($models);
echo $PAGE->get_renderer('tool_analytics')->render($templatable);

echo $OUTPUT->footer();
