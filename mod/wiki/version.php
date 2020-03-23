<?php
//

/**
 * Code fragment to define the version of wiki
 * This fragment is called by moodle_needs_upgrading() and /admin/index.php
 *
 * @package    mod_wiki
 * @copyright  2009 Marc Alier, Jordi Piguillem marc.alier@upc.edu
 * @copyright  2009 Universitat Politecnica de Catalunya http://www.upc.edu
 *
 * @author Jordi Piguillem
 * @author Marc Alier
 * @author David Jimenez
 * @author Josep Arus
 * @author Kenneth Riba
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2019111800;       // The current module version (Date: YYYYMMDDXX)
$plugin->requires  = 2019111200;    // Requires this Moodle version
$plugin->component = 'mod_wiki';       // Full name of the plugin (used for diagnostics)
