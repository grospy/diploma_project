<?php
//


/**
 * This file contains the mnet services for the mahara portfolio plugin
 *
 * @since Moodle 2.0
 * @package moodlecore
 * @subpackage portfolio
 * @copyright 2010 Penny Leach
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$publishes = array(
    'pf' => array(
        'apiversion' => 1,
        'classname'  => 'portfolio_plugin_mahara',
        'filename'   => 'lib.php',
        'methods'    => array(
            'fetch_file'
        ),
    ),
);
$subscribes = array(
    'pf' => array(
        'send_content_intent' => 'portfolio/mahara/lib.php/send_content_intent',
        'send_content_ready'  => 'portfolio/mahara/lib.php/send_content_ready',
    ),
);
