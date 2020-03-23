<?php
//

/**
 * URL external functions and service definitions.
 *
 * @package    mod_url
 * @category   external
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.0
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(

    'mod_url_view_url' => array(
        'classname'     => 'mod_url_external',
        'methodname'    => 'view_url',
        'description'   => 'Trigger the course module viewed event and update the module completion status.',
        'type'          => 'write',
        'capabilities'  => 'mod/url:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),
    'mod_url_get_urls_by_courses' => array(
        'classname'     => 'mod_url_external',
        'methodname'    => 'get_urls_by_courses',
        'description'   => 'Returns a list of urls in a provided list of courses, if no list is provided all urls that the user
                            can view will be returned.',
        'type'          => 'read',
        'capabilities'  => 'mod/url:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);
