<?php

//

/**
 * Definition of log events
 *
 * @package    mod_glossary
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'glossary', 'action'=>'add', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'update', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'view', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'view all', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'add entry', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'update entry', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'add category', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'update category', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'delete category', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'approve entry', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'disapprove entry', 'mtable'=>'glossary', 'field'=>'name'),
    array('module'=>'glossary', 'action'=>'view entry', 'mtable'=>'glossary_entries', 'field'=>'concept'),
);