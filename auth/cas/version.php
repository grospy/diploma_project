<?php
//

/**
 * Version details
 *
 * @package    auth_cas
 * @author     Martin Dougiamas
 * @author     Jerome GUTIERREZ
 * @author     Iñaki Arenaza
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800;        // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2019111200;        // Requires this Moodle version
$plugin->component = 'auth_cas';        // Full name of the plugin (used for diagnostics)

$plugin->dependencies = array('auth_ldap' => 2019111200);
