<?php
//

/**
 * Privacy Subsystem implementation for theme_classic.
 *
 * @package   theme_classic
 * @copyright 2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_classic\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * The classic theme does not store any data.
 *
 * @copyright 2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
