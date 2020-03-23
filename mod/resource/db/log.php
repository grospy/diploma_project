<?php

//

/**
 * Definition of log events
 *
 * @package    mod_resource
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'resource', 'action'=>'view', 'mtable'=>'resource', 'field'=>'name'),
    array('module'=>'resource', 'action'=>'view all', 'mtable'=>'resource', 'field'=>'name'),
    array('module'=>'resource', 'action'=>'update', 'mtable'=>'resource', 'field'=>'name'),
    array('module'=>'resource', 'action'=>'add', 'mtable'=>'resource', 'field'=>'name'),
);