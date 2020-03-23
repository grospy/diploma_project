<?php
//

/**
 * Page external functions and service definitions.
 *
 * @package    mod_page
 * @category   external
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.0
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(

    'mod_page_view_page' => array(
        'classname'     => 'mod_page_external',
        'methodname'    => 'view_page',
        'description'   => 'Simulate the view.php web interface page: trigger events, completion, etc...',
        'type'          => 'write',
        'capabilities'  => 'mod/page:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE)
    ),

    'mod_page_get_pages_by_courses' => array(
        'classname'     => 'mod_page_external',
        'methodname'    => 'get_pages_by_courses',
        'description'   => 'Returns a list of pages in a provided list of courses, if no list is provided all pages that the user
                            can view will be returned.',
        'type'          => 'read',
        'capabilities'  => 'mod/page:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);
