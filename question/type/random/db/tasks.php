<?php
//

/**
 * Definition of question/type/random scheduled tasks.
 *
 * @package   qtype_random
 * @category  task
 * @copyright 2018 Bo Pierce <email.bO.pierce@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'qtype_random\task\remove_unused_questions',
        'blocking' => 0,
        'minute' => 'R',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*'
    )
);
