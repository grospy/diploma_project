<?php
//

/**
 * Definition of log events
 *
 * @package    mod_feedback
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'feedback', 'action'=>'startcomplete', 'mtable'=>'feedback', 'field'=>'name'),
    array('module'=>'feedback', 'action'=>'submit', 'mtable'=>'feedback', 'field'=>'name'),
    array('module'=>'feedback', 'action'=>'delete', 'mtable'=>'feedback', 'field'=>'name'),
    array('module'=>'feedback', 'action'=>'view', 'mtable'=>'feedback', 'field'=>'name'),
    array('module'=>'feedback', 'action'=>'view all', 'mtable'=>'course', 'field'=>'shortname'),
);