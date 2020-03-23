<?php
//

/**
 * Definition of log events
 *
 * @package    mod_scorm
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module' => 'scorm', 'action' => 'view', 'mtable' => 'scorm', 'field' => 'name'),
    array('module' => 'scorm', 'action' => 'review', 'mtable' => 'scorm', 'field' => 'name'),
    array('module' => 'scorm', 'action' => 'update', 'mtable' => 'scorm', 'field' => 'name'),
    array('module' => 'scorm', 'action' => 'add', 'mtable' => 'scorm', 'field' => 'name'),
);