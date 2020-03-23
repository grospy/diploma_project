<?php
//

/**
 * APCu cache store language strings.
 *
 * @package    cachestore_apcu
 * @copyright  2012 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['clusternotice'] = 'Please be aware that APCu is only a suitable choice for single node sites or caches that can be stored locally.
For more information, see the <a href="{$a}">APC user cache documentation</a>.';
$string['notice'] = 'Notice';
$string['pluginname'] = 'APC user cache (APCu)';
$string['prefix'] = 'Prefix';
$string['prefix_help'] = 'The above prefix gets used for all keys being stored in this APC store instance. By default the database prefix is used.';
$string['prefixinvalid'] = 'The prefix you have selected is invalid. You can only use a-z A-Z 0-9-_.';
$string['prefixnotunique'] = 'The prefix you have selected is not unique. Please choose a unique prefix.';
$string['privacy:metadata'] = 'The APC user cache (APCu) plugin stores data briefly as part of its caching functionality but this data is regularly cleared and is not sent externally in any way.';
$string['testperformance'] = 'Test performance';
$string['testperformance_desc'] = 'If enabled, APCu performance will be included when viewing the Test performance page. Enabling this on a production site is not recommended.';
