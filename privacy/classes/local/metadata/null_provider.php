<?php
//

/**
 * This file contains the core_privacy\nodata interface.
 *
 * Plugins implement this interface to declare that they don't store any personal information.
 *
 * @package core_privacy
 * @copyright 2018 Jake Dallimore <jrhdallimore@gmail.com>
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\metadata;

defined('MOODLE_INTERNAL') || die();

interface null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string ;
}
