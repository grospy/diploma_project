<?php
//

/**
 * Class containing data for the Recently accessed courses block.
 *
 * @package    block_recentlyaccessedcourses
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_recentlyaccessedcourses\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;

/**
 * Class containing data for Recently accessed courses block.
 *
 * @package    block_recentlyaccessedcourses
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class main implements renderable, templatable {
    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return \stdClass|array
     */
    public function export_for_template(renderer_base $output) {
        global $USER;

        $nocoursesurl = $output->image_url('courses', 'block_recentlyaccessedcourses')->out(false);
        $config = get_config('block_recentlyaccessedcourses');

        return [
            'userid' => $USER->id,
            'nocoursesimgurl' => $nocoursesurl,
            'pagingbar' => [
                'next' => true,
                'previous' => true
            ],
            'displaycategories' => !empty($config->displaycategories)
        ];
    }
}
