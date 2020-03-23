<?php
//

/**
 * Task definition for block_rss_client.
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali 2018
 * @package   block_rss_client
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => '\block_rss_client\task\refreshfeeds',
        'blocking' => 0,
        'minute' => '*/5',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    )
);

