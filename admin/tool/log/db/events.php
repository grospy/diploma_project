<?php
//

/**
 * Event observer.
 *
 * @package   tool_log
 * @category  event
 * @copyright 2013 Petr Skoda {@link http://skodak.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = array(
    array(
        'eventname' => '*',
        'callback'  => '\tool_log\log\observer::store',
        'internal'  => false, // This means that we get events only after transaction commit.
        'priority'  => 1000,
    ),
);
