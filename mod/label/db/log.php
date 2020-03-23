<?php

//

/**
 * Definition of log events
 *
 * @package    mod_label
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'label', 'action'=>'add', 'mtable'=>'label', 'field'=>'name'),
    array('module'=>'label', 'action'=>'update', 'mtable'=>'label', 'field'=>'name'),
);