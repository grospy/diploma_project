<?php
//

/**
 * Recently accessed items event observer.
 *
 * @package   block_recentlyaccesseditems
 * @category  event
 * @copyright 2018 Victor Deniz <victor@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = array (
    array(
            'eventname'   => '\core\event\course_module_viewed',
            'callback'    => 'block_recentlyaccesseditems\observer::store',
    ),
    array(
            'eventname'   => '\core\event\course_module_deleted',
            'callback'    => 'block_recentlyaccesseditems\observer::remove'
    ),
);