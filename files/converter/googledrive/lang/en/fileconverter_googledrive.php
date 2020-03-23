<?php
//

/**
 * Strings for plugin 'fileconverter_googledrive'
 *
 * @package   fileconverter_googledrive
 * @copyright 2017 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Google Drive';
$string['disabled'] = 'Disabled';
$string['issuer'] = 'OAuth 2 service';
$string['issuer_help'] = 'The OAuth 2 service used to access Google Drive.';
$string['privacy:metadata:fileconverter_googledrive:externalpurpose'] = 'This information is sent to Google Drive API in order the file to be converted to an alternative format. The file is temporarily kept on Google Drive and gets deleted after the conversion is done.';
$string['privacy:metadata:fileconverter_googledrive:filecontent'] = 'The content of the file.';
$string['privacy:metadata:fileconverter_googledrive:filemimetype'] = 'The MIME type of the file.';
$string['privacy:metadata:fileconverter_googledrive:params'] = 'The query parameters passed to Google Drive API.';
$string['test_converter'] = 'Test this converter is working properly.';
$string['test_conversion'] = 'Test document conversion';
$string['test_conversionready'] = 'This document converter is configured properly.';
$string['test_conversionnotready'] = 'This document converter is not configured properly.';
$string['test_issuerinvalid'] = 'The OAuth service in the document converter settings is set to an invalid value.';
$string['test_issuernotenabled'] = 'The OAuth service set in the document converter settings is not enabled.';
$string['test_issuernotconnected'] = 'The OAuth service set in the document converter settings does not have a system account connected.';
$string['test_issuernotset'] = 'The OAuth service needs to be set in the document converter settings.';
