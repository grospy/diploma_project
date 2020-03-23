<?php
//

/**
 * Cache memcached store version information.
 *
 * Not to be confused with the memcache plugin.
 *
 * @package    cachestore_memcached
 * @copyright  2012 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$plugin->version   = 2019111800;    // The current module version (Date: YYYYMMDDXX)
$plugin->requires  = 2019111200;    // Requires this Moodle version.
$plugin->component = 'cachestore_memcached';  // Full name of the plugin.