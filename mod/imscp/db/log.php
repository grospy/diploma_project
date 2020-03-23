<?php
//

/**
 * Definition of log events
 *
 * @package    mod_imscp
 * @category   log
 * @copyright  2010 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module' => 'imscp', 'action' => 'view', 'mtable' => 'imscp', 'field' => 'name'),
    array('module' => 'imscp', 'action' => 'view all', 'mtable' => 'imscp', 'field' => 'name'),
    array('module' => 'imscp', 'action' => 'update', 'mtable' => 'imscp', 'field' => 'name'),
    array('module' => 'imscp', 'action' => 'add', 'mtable' => 'imscp', 'field' => 'name'),
);
