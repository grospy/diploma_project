<?php
//

/**
 * Resource external functions and service definitions.
 *
 * @package    mod_resource
 * @category   external
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.0
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(

    'mod_resource_view_resource' => array(
        'classname'     => 'mod_resource_external',
        'methodname'    => 'view_resource',
        'description'   => 'Simulate the view.php web interface resource: trigger events, completion, etc...',
        'type'          => 'write',
        'capabilities'  => 'mod/resource:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),
    'mod_resource_get_resources_by_courses' => array(
        'classname'     => 'mod_resource_external',
        'methodname'    => 'get_resources_by_courses',
        'description'   => 'Returns a list of files in a provided list of courses, if no list is provided all files that
                            the user can view will be returned.',
        'type'          => 'read',
        'capabilities'  => 'mod/resource:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);
