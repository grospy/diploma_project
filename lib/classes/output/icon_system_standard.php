<?php
//

/**
 * Contains class \core\output\icon_system_standard
 *
 * @package    core
 * @category   output
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

use renderer_base;
use pix_icon;

defined('MOODLE_INTERNAL') || die();

/**
 * Standard icon rendering. No mapping - img tags used.
 *
 * @package    core
 * @category   output
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class icon_system_standard {

    public function render_pix_icon(renderer_base $output, pix_icon $icon) {
        $data = $icon->export_for_template($output);
        return $output->render_from_template('core/pix_icon', $data);
    }

    public function get_amd_name() {
        return 'core/icon_system_standard';
    }

}

