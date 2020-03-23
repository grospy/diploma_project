<?php
//

/**
 * Renderer class for LTI enrolment
 *
 * @package    enrol_lti
 * @copyright  2016 John Okely <john@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_lti\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;
use renderable;

/**
 * Renderer class for LTI enrolment
 *
 * @package    enrol_lti
 * @copyright  2016 John Okely <john@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {
    /**
     * Render the enrol_lti/proxy_registration template
     *
     * @param registration $registration The registration renderable
     * @return string html for the page
     */
    public function render_registration(registration $registration) {
        $data = $registration->export_for_template($this);
        return parent::render_from_template("enrol_lti/proxy_registration", $data);
    }
}
