<?php
//

/**
 * Plugin capabilities.
 *
 * @package    repository_picasa
 * @copyright  2009 Dan Poltawski
 * @author     Dan Poltawski <talktodan@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    'repository/picasa:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'user' => CAP_ALLOW
        )
    )
);
