<?php
//

/**
 * Class containing data for external registration return page.
 *
 * @package    mod_lti
 * @copyright  2015 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_lti\output;

require_once($CFG->dirroot.'/mod/lti/locallib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;

/**
 * Class containing data for tool_configure page
 *
 * @copyright  2015 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class external_registration_return_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output The renderer
     * @return stdClass Data to be used by the template
     */
    public function export_for_template(renderer_base $output) {
        return new stdClass();
    }
}
