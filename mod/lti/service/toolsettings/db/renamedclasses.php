<?php
//

/**
 * Lists renamed classes so that the autoloader can make the old names still work.
 *
 * @package   mod_lti
 * @copyright 2018 Thom Rawson
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Array 'old_class_name' => 'new\class_name'.
$renamedclasses = array(

    // Changed for PHP 7.0 which now has the word "resource" as a reserved word.
    'ltiservice_toolsettings\local\resource\contextsettings' => 'ltiservice_toolsettings\local\resources\contextsettings',
    'ltiservice_toolsettings\local\resource\linksettings' => 'ltiservice_toolsettings\local\resources\linksettings',
    'ltiservice_toolsettings\local\resource\systemsettings' => 'ltiservice_toolsettings\local\resources\systemsettings',
);

