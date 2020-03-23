<?php
//

/**
 * Tag areas in component mod_data
 *
 * @package   mod_data
 * @copyright 2017 Andrew Hancox <andrewdchancox@googlemail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tagareas = array(
    array(
        'itemtype' => 'data_records',
        'component' => 'mod_data',
        'callback' => 'mod_data_get_tagged_records',
        'callbackfile' => '/mod/data/locallib.php',
    ),
);
