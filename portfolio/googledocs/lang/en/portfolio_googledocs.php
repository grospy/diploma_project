<?php
//

/**
 * Strings for component 'portfolio_googledocs', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package   portfolio_googledocs
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['clientid'] = 'Client ID';
$string['noauthtoken'] = 'An authentication token has not been received from Google. Please ensure you are allowing Moodle to access your Google account';
$string['nooauthcredentials'] = 'OAuth credentials required.';
$string['nooauthcredentials_help'] = 'To use the Google Drive portfolio plugin you must configure OAuth credentials in the portfolio settings.';
$string['nosessiontoken'] = 'A session token does not exist preventing export to google.';
$string['oauthinfo'] = '<p>To use this plugin, you must register your site with Google, as described in the documentation <a href="{$a->docsurl}">Google OAuth 2.0 setup</a>.</p><p>As part of the registration process, you will need to enter the following URL as \'Authorized Redirect URIs\':</p><p>{$a->callbackurl}</p><p>Once registered, you will be provided with a client ID and secret which can be used to configure all Google Drive and Picasa plugins.</p>';
$string['pluginname'] = 'Google Drive';
$string['privacy:metadata'] = 'This plugin sends data externally to a linked Google account. It does not store data locally.';
$string['privacy:metadata:data'] = 'Personal data passed through from the portfolio subsystem.';
$string['sendfailed'] = 'The file {$a} failed to transfer to google';
$string['secret'] = 'Secret';
