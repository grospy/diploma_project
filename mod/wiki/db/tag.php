<?php
//

/**
 * Tag areas in component mod_wiki
 *
 * @package   mod_wiki
 * @copyright 2015 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


$tagareas = array(
    array(
        'itemtype' => 'wiki_pages',
        'component' => 'mod_wiki',
        'callback' => 'mod_wiki_get_tagged_pages',
        'callbackfile' => '/mod/wiki/locallib.php',
    ),
);
