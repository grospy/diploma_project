<?php
//

/**
 * Definition of editpdf scheduled tasks.
 *
 * @package   assignfeedback_editpdf
 * @category  task
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/* List of handlers */

$tasks = array(
    array(
        'classname' => 'assignfeedback_editpdf\task\convert_submissions',
        'blocking' => 0,
        'minute' => '*/15',
        'hour' => '*',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    ),
);
