<?php
//

/**
 * IMSCP external functions and service definitions.
 *
 * @package    mod_imscp
 * @category   external
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.0
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(

    'mod_imscp_view_imscp' => array(
        'classname'     => 'mod_imscp_external',
        'methodname'    => 'view_imscp',
        'description'   => 'Simulate the view.php web interface imscp: trigger events, completion, etc...',
        'type'          => 'write',
        'capabilities'  => 'mod/imscp:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),

    'mod_imscp_get_imscps_by_courses' => array(
        'classname'     => 'mod_imscp_external',
        'methodname'    => 'get_imscps_by_courses',
        'description'   => 'Returns a list of IMSCP instances in a provided set of courses,
                            if no courses are provided then all the IMSCP instances the user has access to will be returned.',
        'type'          => 'read',
        'capabilities'  => 'mod/imscp:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),

);
