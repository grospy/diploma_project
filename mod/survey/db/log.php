<?php

//

/**
 * Definition of log events
 *
 * @package    mod_survey
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'survey', 'action'=>'add', 'mtable'=>'survey', 'field'=>'name'),
    array('module'=>'survey', 'action'=>'update', 'mtable'=>'survey', 'field'=>'name'),
    array('module'=>'survey', 'action'=>'download', 'mtable'=>'survey', 'field'=>'name'),
    array('module'=>'survey', 'action'=>'view form', 'mtable'=>'survey', 'field'=>'name'),
    array('module'=>'survey', 'action'=>'view graph', 'mtable'=>'survey', 'field'=>'name'),
    array('module'=>'survey', 'action'=>'view report', 'mtable'=>'survey', 'field'=>'name'),
    array('module'=>'survey', 'action'=>'submit', 'mtable'=>'survey', 'field'=>'name'),
);