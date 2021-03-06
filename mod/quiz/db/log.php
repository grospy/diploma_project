<?php
//

/**
 * Definition of log events for the quiz module.
 *
 * @package    mod_quiz
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'quiz', 'action'=>'add', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'update', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'view', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'report', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'attempt', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'submit', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'review', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'editquestions', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'preview', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'start attempt', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'close attempt', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'continue attempt', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'edit override', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'delete override', 'mtable'=>'quiz', 'field'=>'name'),
    array('module'=>'quiz', 'action'=>'view summary', 'mtable'=>'quiz', 'field'=>'name'),
);