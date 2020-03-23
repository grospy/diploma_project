<?php

//

/**
 * Defines message providers (types of messages being sent)
 *
 * @package   mod_forum
 * @copyright 1999 onwards  Martin Dougiamas  http://moodle.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$messageproviders = array (
    // Ordinary single forum posts.
    'posts' => array(
        'defaults' => array(
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
    ),

    // Forum digest messages.
    'digests' => array(
    ),
);
