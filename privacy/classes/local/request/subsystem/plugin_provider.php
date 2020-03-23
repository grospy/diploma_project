<?php
//

/**
 * This file contains the \core_privacy\local\request\subsystem\plugin_provider interface to describe
 * a class which provides data in some form for a subsystem.
 *
 * @package    core_privacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request\subsystem;

defined('MOODLE_INTERNAL') || die();

/**
 * The plugin_provider interface for subsystems which provide data directly to a plugin.
 *
 * @package    core_privacy
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 */
interface plugin_provider extends \core_privacy\local\request\shared_data_provider {
}
