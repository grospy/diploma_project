<?php
//

/**
 * Contains the data registry compliance renderable.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Adrian Greeve
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_dataprivacy\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;

/**
 * Class containing the data registry compliance renderable
 *
 * @copyright  2018 Adrian Greeve
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class data_registry_compliance_page implements renderable, templatable {

    /** @var array meta-data to be displayed about the system. */
    protected $metadata;

    /**
     * Constructor.
     *
     * @param array $metadata
     */
    public function __construct($metadata) {
        $this->metadata = $metadata;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        return ['types' => $this->metadata];
    }
}
