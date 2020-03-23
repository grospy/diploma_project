<?php
//

/**
 * Web service for Recently accessed items block
 *
 * @package    block_recentlyaccesseditems
 * @since      Moodle 3.6
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = array(
    'block_recentlyaccesseditems_get_recent_items' => array(
        'classname' => 'block_recentlyaccesseditems\external',
        'methodname' => 'get_recent_items',
        'classpath' => '',
        'description' => 'List of items a user has accessed most recently.',
        'type' => 'read',
        'ajax' => true,
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
);