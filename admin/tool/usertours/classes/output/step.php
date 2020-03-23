<?php
//

/**
 * Tour Step Renderable.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_usertours\output;

defined('MOODLE_INTERNAL') || die();

use tool_usertours\step as stepsource;

/**
 * Tour Step Renderable.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class step implements \renderable {

    /**
     * @var The step instance.
     */
    protected $step;

    /**
     * The step output.
     *
     * @param   stepsource      $step       The step being output.
     */
    public function __construct(stepsource $step) {
        $this->step = $step;
    }

    /**
     * Export the step configuration.
     *
     * @param   renderer_base   $output     The renderer.
     * @return  object
     */
    public function export_for_template(\renderer_base $output) {
        global $PAGE;
        $step = $this->step;

        $result = (object) [
            'stepid'    => $step->get_id(),
            'title'     => external_format_text(
                    stepsource::get_string_from_input($step->get_title()),
                    FORMAT_HTML,
                    $PAGE->context->id,
                    'tool_usertours'
                )[0],
            'content'   => external_format_text(
                    stepsource::get_string_from_input($step->get_content()),
                    FORMAT_HTML,
                    $PAGE->context->id,
                    'tool_usertours'
                )[0],
            'element'   => $step->get_target()->convert_to_css(),
        ];

        $result->content = str_replace("\n", "<br>\n", $result->content);

        foreach ($step->get_config_keys() as $key) {
            $result->$key = $step->get_config($key);
        }

        return $result;
    }
}
