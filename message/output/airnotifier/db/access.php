<?php
//

/**
 * Capability definitions for airnotifier.
 *
 * @package   message_airnotifier
 * @category  access
 * @copyright 2012 Jerome Mouneyrac
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    'message/airnotifier:managedevice' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'user' => CAP_ALLOW
        )
    )
);
