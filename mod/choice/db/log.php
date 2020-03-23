<?php

//

/**
 * Definition of log events
 *
 * @package    mod_choice
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'choice', 'action'=>'view', 'mtable'=>'choice', 'field'=>'name'),
    array('module'=>'choice', 'action'=>'update', 'mtable'=>'choice', 'field'=>'name'),
    array('module'=>'choice', 'action'=>'add', 'mtable'=>'choice', 'field'=>'name'),
    array('module'=>'choice', 'action'=>'report', 'mtable'=>'choice', 'field'=>'name'),
    array('module'=>'choice', 'action'=>'choose', 'mtable'=>'choice', 'field'=>'name'),
    array('module'=>'choice', 'action'=>'choose again', 'mtable'=>'choice', 'field'=>'name'),
);