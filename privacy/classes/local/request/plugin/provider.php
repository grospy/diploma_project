<?php
//

/**
 * This file contains the \core_privacy\local\request\plugin\provider interface to describe
 * a class which provides data in some form for a plugin.
 *
 * Plugins should implement this if they store any personal information.
 *
 * @package core_privacy
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request\plugin;

defined('MOODLE_INTERNAL') || die();

/**
 * The provider interface for plugins which provide data from a plugin
 * directly to the Privacy subsystem.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface provider extends \core_privacy\local\request\core_user_data_provider {
}
