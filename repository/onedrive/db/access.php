<?php
//

/**
 * Capability definitions for onedrive repository
 *
 * @package    repository_onedrive
 * @copyright  2012 Lancaster University Network Services Ltd
 * @author     Dan Poltawski <dan.poltawski@luns.net.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$capabilities = array(
    'repository/onedrive:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'user' => CAP_ALLOW
        )
    )
);
