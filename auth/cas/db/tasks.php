<?php
//

/**
 * Definition of auth_cas tasks.
 *
 * @package    auth_cas
 * @category   task
 * @copyright  2015 Vadim Dvorovenko <Vadimon@mail.ru>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'auth_cas\task\sync_task',
        'blocking' => 0,
        'minute' => '0',
        'hour' => '0',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 1
    )
);
