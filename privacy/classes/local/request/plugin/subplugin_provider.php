<?php
//

/**
 * This file contains the \core_privacy\local\request\plugin\subplugin_provider
 * interface to describe a class which provides data in some form for the
 * subplugin of another plugin.
 *
 * It should not be implemented directly, but should be extended by the
 * plugin providing a subplugin.
 *
 * @package    core_privacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request\plugin;

defined('MOODLE_INTERNAL') || die();

/**
 * The subplugin_provider interface is for plugins which are sub-plugins of
 * a plugin. They do not provide data directly to the core Privacy
 * subsystem, but will be accessed and called via the plugin itself.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface subplugin_provider extends \core_privacy\local\request\shared_data_provider {
}
