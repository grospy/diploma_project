<?php
//

/**
 * Provides {@link tool_policy\output\renderer} class.
 *
 * @package     tool_policy
 * @category    output
 * @copyright   2018 Sara Arjona <sara@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_policy\output;

defined('MOODLE_INTERNAL') || die();

use moodle_url;
use renderable;
use renderer_base;
use templatable;
use tool_policy\api;
use tool_policy\policy_version;

/**
 * Renderer for the policies plugin.
 *
 * @copyright 2018 Sara Arjona <sara@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class guestconsent implements renderable, templatable {

    /**
     * Export the page data for the mustache template.
     *
     * @param renderer_base $output renderer to be used to render the page elements.
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $PAGE;

        $data = (object) [];
        $data->pluginbaseurl = (new moodle_url('/admin/tool/policy'))->out(true);
        if (strpos(qualified_me(), '/tool/policy/view.php') === false) {
            // Current page is not a policy doc, so returnurl parameter will be it.
            $data->returnurl = qualified_me();
        } else {
            // If current page is also a policy doc to view, get previous returnurl parameter to avoid error.
            $returnurl = $PAGE->url->get_param('returnurl');
            if (isset($returnurl)) {
                $data->returnurl = $returnurl;
            }
        }
        $data->returnurl = urlencode($data->returnurl);

        $policies = api::list_current_versions(policy_version::AUDIENCE_GUESTS);
        $data->policies = array_values($policies);
        $data->haspolicies = !empty($policies);

        return $data;
    }
}
