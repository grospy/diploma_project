<?php
//

/**
 * LTI web service endpoints
 *
 * @package    mod_lti
 * @category   log
 * @copyright  Copyright (c) 2011 Moodlerooms Inc. (http://www.moodlerooms.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Chris Scribner
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module' => 'lti', 'action' => 'view', 'mtable' => 'lti', 'field' => 'name'),
    array('module' => 'lti', 'action' => 'launch', 'mtable' => 'lti', 'field' => 'name'),
    array('module' => 'lti', 'action' => 'view all', 'mtable' => 'lti', 'field' => 'name')
);