<?php
//
/**
 * Class containing data for Recently accessed items block.
 *
 * @package    block_recentlyaccesseditems
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_recentlyaccesseditems\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;

/**
 * Class containing data for Recently accessed items block.
 *
 * @package    block_recentlyaccesseditems
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class main implements renderable, templatable {
    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param \renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {

        $noitemsimgurl = $output->image_url('items', 'block_recentlyaccesseditems')->out();

        return [
            'noitemsimgurl' => $noitemsimgurl
        ];
    }
}