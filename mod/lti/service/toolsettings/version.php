<?php
//

/**
 * Version information for the ltiservice_toolsettings service.
 *
 * @package    ltiservice_toolsettings
 * @copyright  2014 Vital Source Technologies http://vitalsource.com
 * @author     Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


$plugin->version   = 2019111800;
$plugin->requires  = 2019111200;
$plugin->component = 'ltiservice_toolsettings';
$plugin->dependencies = array(
    'ltiservice_profile' => 2019111200,
    'ltiservice_toolproxy' => 2019111200
);
