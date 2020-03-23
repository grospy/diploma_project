<?php
//

/**
 * The library file for the session cache store.
 *
 * This file is part of the session cache store, it contains the API for interacting with an instance of the store.
 * This is used as a default cache store within the Cache API. It should never be deleted.
 *
 * @package    cachestore_session
 * @category   cache
 * @copyright  2012 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Session cache';
$string['privacy:metadata:core_user'] = 'The Session cachestore plugin stores data briefly as part of its caching functionality. This data is stored in the short-lived user session.';
