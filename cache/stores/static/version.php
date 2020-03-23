<?php
//

/**
 * Cache static store version information.
 *
 * This is used as a default cache store within the Cache API. It should never be deleted.
 *
 * @package    cachestore_static
 * @category   cache
 * @copyright  2012 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$plugin->version   = 2019111800;    // The current module version (Date: YYYYMMDDXX)
$plugin->requires  = 2019111200;    // Requires this Moodle version.
$plugin->component = 'cachestore_static';  // Full name of the plugin.