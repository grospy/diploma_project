<?php
//

/**
 * Task definition for enrol_category.
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @package   enrol_category
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\enrol_category\task\enrol_category_sync',
        'blocking' => 0,
        'minute' => '*',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    )
);

