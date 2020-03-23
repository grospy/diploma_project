<?php

//

/**
 * Definition of log events
 *
 * @package    mod_data
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'data', 'action'=>'view', 'mtable'=>'data', 'field'=>'name'),
    array('module'=>'data', 'action'=>'add', 'mtable'=>'data', 'field'=>'name'),
    array('module'=>'data', 'action'=>'update', 'mtable'=>'data', 'field'=>'name'),
    array('module'=>'data', 'action'=>'record delete', 'mtable'=>'data', 'field'=>'name'),
    array('module'=>'data', 'action'=>'fields add', 'mtable'=>'data_fields', 'field'=>'name'),
    array('module'=>'data', 'action'=>'fields update', 'mtable'=>'data_fields', 'field'=>'name'),
    array('module'=>'data', 'action'=>'templates saved', 'mtable'=>'data', 'field'=>'name'),
    array('module'=>'data', 'action'=>'templates def', 'mtable'=>'data', 'field'=>'name'),
);