<?php
//

/**
 * Definition of log events associated with the current component
 *
 * The log events defined on this file are processed and stored into
 * the Moodle DB after any install or upgrade operation. All plugins
 * support this.
 *
 * For more information, take a look to the documentation available:
 *     - Logging API: {@link http://docs.moodle.org/dev/Logging_API}
 *     - Upgrade API: {@link http://docs.moodle.org/dev/Upgrade_API}
 *
 * @package   core
 * @category  log
 * @copyright 2010 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $DB; // TODO: this is a hack, we should really do something with the SQL in SQL tables

$logs = array(
    array('module'=>'course', 'action'=>'user report', 'mtable'=>'user', 'field'=>$DB->sql_concat('firstname', "' '" , 'lastname')),
    array('module'=>'course', 'action'=>'view', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'view section', 'mtable'=>'course_sections', 'field'=>'name'),
    array('module'=>'course', 'action'=>'update', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'hide', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'show', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'move', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'enrol', 'mtable'=>'course', 'field'=>'fullname'), // there should be some way to store user id of the enrolled user!
    array('module'=>'course', 'action'=>'unenrol', 'mtable'=>'course', 'field'=>'fullname'), // there should be some way to store user id of the enrolled user!
    array('module'=>'course', 'action'=>'report log', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'report live', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'report outline', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'report participation', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'course', 'action'=>'report stats', 'mtable'=>'course', 'field'=>'fullname'),
    array('module'=>'category', 'action'=>'add', 'mtable'=>'course_categories', 'field'=>'name'),
    array('module'=>'category', 'action'=>'hide', 'mtable'=>'course_categories', 'field'=>'name'),
    array('module'=>'category', 'action'=>'move', 'mtable'=>'course_categories', 'field'=>'name'),
    array('module'=>'category', 'action'=>'show', 'mtable'=>'course_categories', 'field'=>'name'),
    array('module'=>'category', 'action'=>'update', 'mtable'=>'course_categories', 'field'=>'name'),
    array('module'=>'message', 'action'=>'write', 'mtable'=>'user', 'field'=>$DB->sql_concat('firstname', "' '" , 'lastname')),
    array('module'=>'message', 'action'=>'read', 'mtable'=>'user', 'field'=>$DB->sql_concat('firstname', "' '" , 'lastname')),
    array('module'=>'message', 'action'=>'add contact', 'mtable'=>'user', 'field'=>$DB->sql_concat('firstname', "' '" , 'lastname')),
    array('module'=>'message', 'action'=>'remove contact', 'mtable'=>'user', 'field'=>$DB->sql_concat('firstname', "' '" , 'lastname')),
    array('module'=>'message', 'action'=>'block contact', 'mtable'=>'user', 'field'=>$DB->sql_concat('firstname', "' '" , 'lastname')),
    array('module'=>'message', 'action'=>'unblock contact', 'mtable'=>'user', 'field'=>$DB->sql_concat('firstname', "' '" , 'lastname')),
    array('module'=>'group', 'action'=>'view', 'mtable'=>'groups', 'field'=>'name'),
    array('module'=>'tag', 'action'=>'update', 'mtable'=>'tag', 'field'=>'name'),
    array('module'=>'tag', 'action'=>'flag', 'mtable'=>'tag', 'field'=>'name'),
    array('module'=>'user', 'action'=>'view', 'mtable'=>'user', 'field'=>$DB->sql_concat('firstname', "' '" , 'lastname')),
);
