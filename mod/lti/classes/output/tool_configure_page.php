<?php
//

/**
 * Class containing data for tool_configure page
 *
 * @package    mod_lti
 * @copyright  2015 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_lti\output;

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/mod/lti/locallib.php');

use moodle_url;
use renderable;
use templatable;
use renderer_base;
use stdClass;
use help_icon;

/**
 * Class containing data for tool_configure page
 *
 * @copyright  2015 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_configure_page implements renderable, templatable {
    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output The renderer
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();

        $keyhelp = new help_icon('resourcekey', 'mod_lti');
        $secrethelp = new help_icon('password', 'mod_lti');

        $url = new moodle_url('/mod/lti/typessettings.php', array('sesskey' => sesskey(), 'returnto' => 'toolconfigure'));
        $data->configuremanualurl = $url->out();
        $url = new moodle_url('/admin/settings.php?section=modsettinglti');
        $data->managetoolsurl = $url->out();
        $url = new moodle_url('/mod/lti/toolproxies.php');
        $data->managetoolproxiesurl = $url->out();
        $data->keyhelp = $keyhelp->export_for_template($output);
        $data->secrethelp = $secrethelp->export_for_template($output);
        return $data;
    }
}
