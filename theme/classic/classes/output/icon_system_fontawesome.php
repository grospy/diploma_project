<?php
//

/**
 * Overridden fontawesome icons.
 *
 * @package     theme_classic
 * @copyright   2019 Moodle
 * @author      Bas Brands <bas@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace theme_classic\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Class overriding some of the Moodle default FontAwesome icons.
 *
 * @package    theme_classic
 * @copyright  2019 Moodle
 * @author     Bas Brands <bas@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class icon_system_fontawesome extends \core\output\icon_system_fontawesome {
    /**
     * Change the core icon map.
     *
     * @return Array replaced icons.
     */
    public function get_core_icon_map() {
        $iconmap = parent::get_core_icon_map();

        $iconmap['core:i/navigationitem'] = 'fa-square';

        return $iconmap;
    }
}
