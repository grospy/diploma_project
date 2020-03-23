<?php
//

/**
 * Inbound Message Handlers for core.
 *
 * @package    core_message
 * @copyright  2014 Andrew NIcols
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$handlers = array(
    array(
        'classname' => '\core\message\inbound\private_files_handler',
        'defaultexpiration' => 0,
    ),
);
