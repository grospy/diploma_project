<?php
//

/**
 * Moodle's lib to use for the Google API.
 *
 * @package    core
 * @copyright  2014 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// All Google API classes support autoload with this.
require_once($CFG->libdir . '/google/src/Google/autoload.php');
// To be able to use our custom IO class.
require_once($CFG->libdir . '/google/curlio.php');

/**
 * Wrapper to get a Google Client object.
 *
 * This automatically sets the config to Moodle's defaults.
 *
 * @return Google_Client
 */
function get_google_client() {
    global $CFG, $SITE;

    make_temp_directory('googleapi');
    $tempdir = $CFG->tempdir . '/googleapi';

    $config = new Google_Config();
    $config->setApplicationName('Moodle ' . $CFG->release);
    $config->setIoClass('moodle_google_curlio');
    $config->setClassConfig('Google_Cache_File', 'directory', $tempdir);
    $config->setClassConfig('Google_Auth_OAuth2', 'access_type', 'online');
    $config->setClassConfig('Google_Auth_OAuth2', 'approval_prompt', 'auto');

    return new Google_Client($config);
}
