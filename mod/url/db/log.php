<?php

//

/**
 * Definition of log events
 *
 * @package    mod_url
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'url', 'action'=>'view', 'mtable'=>'url', 'field'=>'name'),
    array('module'=>'url', 'action'=>'view all', 'mtable'=>'url', 'field'=>'name'),
    array('module'=>'url', 'action'=>'update', 'mtable'=>'url', 'field'=>'name'),
    array('module'=>'url', 'action'=>'add', 'mtable'=>'url', 'field'=>'name'),
);