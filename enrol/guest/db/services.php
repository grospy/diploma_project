<?php
//

/**
 * Guest enrolment external functions and service definitions.
 *
 * @package    enrol_guest
 * @category   external
 * @copyright  2015 Juan Leyva <juan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      Moodle 3.1
 */

$functions = array(

    'enrol_guest_get_instance_info' => array(
        'classname'   => 'enrol_guest_external',
        'methodname'  => 'get_instance_info',
        'description' => 'Return guest enrolment instance information.',
        'type'        => 'read',
        'services'    => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);
