<?php
//

/**
 * Atto text editor recordrtc capabilities.
 *
 * @package    atto_recordrtc
 * @copyright  2018 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = [
    // Capability to record audio using this plugin.
    'atto/recordrtc:recordaudio' => [
        'captype'      => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => [
            'user' => CAP_ALLOW,
        ],
    ],
    // Capability to record video using this plugin.
    'atto/recordrtc:recordvideo' => [
        'captype'      => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes'   => [
            'user' => CAP_ALLOW,
        ],
    ],
];
