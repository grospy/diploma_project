<?php
//

/**
 * Report insights webservice definitions.
 *
 * @package    report_insights
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = array(

    'report_insights_set_notuseful_prediction' => array(
        'classname'   => 'report_insights\external',
        'methodname'  => 'set_notuseful_prediction',
        'description' => 'Flags the prediction as not useful.',
        'type'        => 'write',
        'ajax'          => true,
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),

    'report_insights_set_fixed_prediction' => array(
        'classname'   => 'report_insights\external',
        'methodname'  => 'set_fixed_prediction',
        'description' => 'Flags a prediction as fixed.',
        'type'        => 'write',
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
        'ajax'          => true,
    ),

    'report_insights_action_executed' => array(
        'classname'   => 'report_insights\external',
        'methodname'  => 'action_executed',
        'description' => 'Stores an action executed over a group of predictions.',
        'type'        => 'write',
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
        'ajax'          => true,
    )

);

