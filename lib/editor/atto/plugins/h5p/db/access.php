<?php
//

/**
 * H5P Atto button capabilities.
 *
 * @package    atto_h5p
 * @copyright  2019 Bas Brands <bas@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'atto/h5p:addembed' => [
        'captype'      => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => [
            'editingteacher' => CAP_ALLOW,
        ],
    ]
];
