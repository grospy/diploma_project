<?php
//

/**
 * Manual plugin external functions and service definitions.
 *
 * @package    enrol_manual
 * @category   webservice
 * @copyright  2011 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(

    // === enrol related functions ===
    'enrol_manual_enrol_users' => array(
        'classname'   => 'enrol_manual_external',
        'methodname'  => 'enrol_users',
        'classpath'   => 'enrol/manual/externallib.php',
        'description' => 'Manual enrol users',
        'capabilities'=> 'enrol/manual:enrol',
        'type'        => 'write',
    ),

    'enrol_manual_unenrol_users' => array(
        'classname'   => 'enrol_manual_external',
        'methodname'  => 'unenrol_users',
        'classpath'   => 'enrol/manual/externallib.php',
        'description' => 'Manual unenrol users',
        'capabilities'=> 'enrol/manual:unenrol',
        'type'        => 'write',
    ),

);
