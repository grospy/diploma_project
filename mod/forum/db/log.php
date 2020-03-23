<?php

//

/**
 * Definition of log events
 *
 * @package    mod_forum
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $DB; // TODO: this is a hack, we should really do something with the SQL in SQL tables.

$logs = array(
    array('module' => 'forum', 'action' => 'add', 'mtable' => 'forum', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'update', 'mtable' => 'forum', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'add discussion', 'mtable' => 'forum_discussions', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'add post', 'mtable' => 'forum_posts', 'field' => 'subject'),
    array('module' => 'forum', 'action' => 'update post', 'mtable' => 'forum_posts', 'field' => 'subject'),
    array('module' => 'forum', 'action' => 'user report', 'mtable' => 'user',
          'field'  => $DB->sql_concat('firstname', "' '", 'lastname')),
    array('module' => 'forum', 'action' => 'move discussion', 'mtable' => 'forum_discussions', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'view subscribers', 'mtable' => 'forum', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'view discussion', 'mtable' => 'forum_discussions', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'view forum', 'mtable' => 'forum', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'subscribe', 'mtable' => 'forum', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'unsubscribe', 'mtable' => 'forum', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'pin discussion', 'mtable' => 'forum_discussions', 'field' => 'name'),
    array('module' => 'forum', 'action' => 'unpin discussion', 'mtable' => 'forum_discussions', 'field' => 'name'),
);