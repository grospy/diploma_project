<?php
//

/**
 * File description.
 *
 * @package   block_starredcourses
 * @copyright 2018 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = array(

    'block_starredcourses_get_starred_courses' => array(
        'classpath' => 'block/starredcourses/classes/external.php',
        'classname'   => 'block_starredcourses_external',
        'methodname'  => 'get_starred_courses',
        'description' => 'Get users starred courses.',
        'type'        => 'read',
        'ajax'        => true,
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);

