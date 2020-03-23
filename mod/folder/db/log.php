<?php

//

/**
 * Definition of log events
 *
 * @package    mod_folder
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'folder', 'action'=>'view', 'mtable'=>'folder', 'field'=>'name'),
    array('module'=>'folder', 'action'=>'view all', 'mtable'=>'folder', 'field'=>'name'),
    array('module'=>'folder', 'action'=>'update', 'mtable'=>'folder', 'field'=>'name'),
    array('module'=>'folder', 'action'=>'add', 'mtable'=>'folder', 'field'=>'name'),
);