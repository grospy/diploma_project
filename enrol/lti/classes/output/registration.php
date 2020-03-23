<?php
//

/**
 * Tool registration page class.
 *
 * @package    enrol_lti
 * @copyright  2016 John Okely <john@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace enrol_lti\output;

defined('MOODLE_INTERNAL') || die;

use renderable;
use renderer_base;
use templatable;
use stdClass;

/**
 * Tool registration page class.
 *
 * @package    enrol_lti
 * @copyright  2016 John Okely <john@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class registration implements renderable, templatable {

    /** @var returnurl The url to which the tool proxy should return */
    protected $returnurl;

    /**
     * Construct a new tool registration page
     * @param string|null $returnurl The url the consumer wants us to return the user to (optional)
     */
    public function __construct($returnurl = null) {
        $this->returnurl = $returnurl;
    }

    /**
     * Export the data.
     *
     * @param renderer_base $output
     * @return stdClass Data to be used for the template
     */
    public function export_for_template(renderer_base $output) {

        $data = new stdClass();
        $data->returnurl = $this->returnurl;

        return $data;
    }
}
