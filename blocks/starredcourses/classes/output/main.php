<?php
//

/**
 * Class containing data for starred courses block.
 *
 * @package     block_starredcourses
 * @copyright   2018 Simey Lameze <simey@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_starredcourses\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;
use core_course\external\course_summary_exporter;

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->libdir . '/completionlib.php');

/**
 * Class containing data for starred courses block.
 *
 * @copyright 2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class main implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param \renderer_base $output
     * @return array
     */
    public function export_for_template(renderer_base $output) {
        global $USER;

        $nocoursesurl = $output->image_url('courses', 'block_starredcourses')->out();
        $config = get_config('block_starredcourses');

        return [
            'userid' => $USER->id,
            'nocoursesimg' => $nocoursesurl,
            'displaycategories' => !empty($config->displaycategories)
        ];
    }
}
