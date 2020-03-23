<?php
//

/**
 * Book module capability definition
 *
 * @package    booktool_exportimscp
 * @copyright  2011 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$capabilities = array(
    'booktool/exportimscp:export' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE
    ),
);
