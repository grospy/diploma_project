<?php
//

/**
 * Manage enabled backpacks for the site.
 *
 * @package    core_badges
 * @copyright  2019 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_badges\output;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/badgeslib.php');

use core_badges\external\backpack_exporter;

/**
 * Manage enabled backpacks renderable.
 *
 * @package    core_badges
 * @copyright  2019 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class external_backpacks_page implements \renderable {

    /**
     * Constructor.
     * @param \moodle_url $url
     */
    public function __construct(\moodle_url $url) {
        $this->url = $url;

        $this->backpacks = badges_get_site_backpacks();
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output Renderer base.
     * @return stdClass
     */
    public function export_for_template(\renderer_base $output) {
        $data = new \stdClass();
        $data->baseurl = $this->url;
        $data->backpacks = array();
        $data->sesskey = sesskey();
        foreach ($this->backpacks as $backpack) {
            $exporter = new backpack_exporter($backpack);
            $backpack = $exporter->export($output);
            if ($backpack->apiversion == OPEN_BADGES_V2) {
                $backpack->canedit = true;
            } else {
                $backpack->canedit = false;
            }
            $data->backpacks[] = $backpack;
        }
        $data->warning = badges_verify_site_backpack();

        return $data;
    }
}
