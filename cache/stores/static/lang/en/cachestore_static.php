<?php
//

/**
 * The library file for the static cache store.
 *
 * This file is part of the static cache store, it contains the API for interacting with an instance of the store.
 * This is used as a default cache store within the Cache API. It should never be deleted.
 *
 * @package    cachestore_static
 * @category   cache
 * @copyright  2012 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Static request cache';
$string['privacy:metadata'] = 'The Static request cachestore plugin stores some data, but this is only present for the lifetime of a single HTTP request.';
