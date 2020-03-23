<?php
//

/**
 * Tag areas in component mod_glossary
 *
 * @package   mod_glossary
 * @copyright 2017 Andrew Hancox <andrewdchancox@googlemail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


$tagareas = array(
    array(
        'itemtype' => 'glossary_entries',
        'component' => 'mod_glossary',
        'callback' => 'mod_glossary_get_tagged_entries',
        'callbackfile' => '/mod/glossary/locallib.php',
    ),
);
