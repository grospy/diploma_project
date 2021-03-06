<?php
//

/**
 * Legacy log reader lang strings.
 *
 * @package    logstore_legacy
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['eventlegacylogged'] = 'Legacy event logged';
$string['loglegacy'] = 'Log legacy data';
$string['loglegacy_help'] = 'This plugin records log data to the legacy log table (mdl_log). This functionality has been replaced by newer, richer and more efficient logging plugins, so you should only run this plugin if you have old custom reports that directly query the old log table. Writing to the legacy logs will increase load, so it is recommended that you disable this plugin for performance reasons when it is not needed.';
$string['pluginname'] = 'Legacy log';
$string['pluginname_desc'] = 'A log plugin that stores log entries in the legacy log table.';
$string['privacy:metadata:log'] = 'A collection of past events';
$string['privacy:metadata:log:action'] = 'A description of the action';
$string['privacy:metadata:log:info'] = 'Additional information';
$string['privacy:metadata:log:ip'] = 'The IP address used at the time of the event';
$string['privacy:metadata:log:time'] = 'The time when the action took place';
$string['privacy:metadata:log:url'] = 'The URL related to the event';
$string['privacy:metadata:log:userid'] = 'The ID of the user who performed the action';
$string['taskcleanup'] = 'Legacy log table cleanup';
