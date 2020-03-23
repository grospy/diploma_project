<?php
//

/**
 * Tag areas in component mod_book
 *
 * @package   mod_book
 * @copyright 2017 Andrew Hancox <andrewdchancox@googlemail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


$tagareas = array(
    array(
        'itemtype' => 'book_chapters',
        'component' => 'mod_book',
        'callback' => 'mod_book_get_tagged_chapters',
        'callbackfile' => '/mod/book/locallib.php',
    ),
);
