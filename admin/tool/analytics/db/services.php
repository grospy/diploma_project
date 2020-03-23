<?php
//

/**
 * Tool analytics webservice definitions.
 *
 * @package    tool_analytics
 * @copyright  2019 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = array(

    'tool_analytics_potential_contexts' => array(
        'classname'   => 'tool_analytics\external',
        'methodname'  => 'potential_contexts',
        'description' => 'Retrieve the list of potential contexts for a model.',
        'type'        => 'read',
        'ajax'          => true,
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),
);
