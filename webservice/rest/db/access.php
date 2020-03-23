<?php
//


/**
 * REST server related capabilities
 *
 * @package    webservice_rest
 * @category   access
 * @copyright  2009 Petr Skodak
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$capabilities = array(

    'webservice/rest:use' => array(
        'captype' => 'read', // in fact this may be considered read and write at the same time
        'contextlevel' => CONTEXT_COURSE, // the context level should be probably CONTEXT_MODULE
        'archetypes' => array(
        ),
    ),

);
