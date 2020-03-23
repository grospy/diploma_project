<?php

//

/**
 * Defines message providers (types of messages being sent)
 *
 * @package mod_lesson
 * @copyright 2010 Andrew Davis
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$messageproviders = array (

    // essay graded notification
    'graded_essay' => array (
        'defaults' => array(
            'airnotifier' => MESSAGE_PERMITTED + MESSAGE_DEFAULT_LOGGEDIN + MESSAGE_DEFAULT_LOGGEDOFF,
        ),
    )

);



