<?php
//

/**
 * Template plans renderable.
 *
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lp\output;
defined('MOODLE_INTERNAL') || die();

/**
 * Template plans renderable.
 *
 * @package    tool_lp
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class template_plans_page implements \renderable {

    /**
     * Constructor.
     * @param \core_competency\template $template
     * @param \moodle_url $url
     */
    public function __construct(\core_competency\template $template, \moodle_url $url) {
        $this->template = $template;
        $this->url = $url;
        $this->table = new template_plans_table('tplplans', $template);
        $this->table->define_baseurl($url);
    }

}
