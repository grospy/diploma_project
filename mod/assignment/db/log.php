<?php

//

/**
 * Definition of log events
 *
 * @package    mod_assignment
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'assignment', 'action'=>'view', 'mtable'=>'assignment', 'field'=>'name'),
    array('module'=>'assignment', 'action'=>'add', 'mtable'=>'assignment', 'field'=>'name'),
    array('module'=>'assignment', 'action'=>'update', 'mtable'=>'assignment', 'field'=>'name'),
    array('module'=>'assignment', 'action'=>'view submission', 'mtable'=>'assignment', 'field'=>'name'),
    array('module'=>'assignment', 'action'=>'upload', 'mtable'=>'assignment', 'field'=>'name'),
);