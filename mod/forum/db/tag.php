<?php
//

/**
 * Tag areas in component mod_forum
 *
 * @package   mod_forum
 * @copyright 2017 Andrew Hancox <andrewdchancox@googlemail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


$tagareas = array(
    array(
        'itemtype' => 'forum_posts',
        'component' => 'mod_forum',
        'callback' => 'mod_forum_get_tagged_posts',
        'callbackfile' => '/mod/forum/locallib.php',
    ),
);
