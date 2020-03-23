<?php
//

/**
 * The chooser renderable.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;
defined('MOODLE_INTERNAL') || die();

use lang_string;
use moodle_url;
use renderer_base;
use renderable;
use stdClass;
use templatable;

/**
 * The chooser renderable class.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class chooser implements renderable, templatable {

    /** @var moodle_url The form action URL. */
    public $actionurl;
    /** @var lang_string The instructions to display. */
    public $instructions;
    /** @var string The form method. */
    public $method = 'post';
    /** @var string The name of the parameter for the items value. */
    public $paramname;
    /** @var array The list of hidden parameters. See {@link self::add_param}. */
    public $params = [];
    /** @var chooser_section[] The sections */
    public $sections;
    /** @var lang_string The chooser title. */
    public $title;

    /**
     * Constructor.
     *
     * @param moodle_url $actionurl The form action URL.
     * @param lang_string $title The title of the chooser.
     * @param chooser_section[] $sections The sections.
     * @param string $paramname The name of the parameter for the items value.
     */
    public function __construct(moodle_url $actionurl, lang_string $title, array $sections, $paramname) {
        $this->actionurl = $actionurl;
        $this->title = $title;
        $this->sections = $sections;
        $this->paramname = $paramname;
    }

    /**
     * Add a parameter to submit with the form.
     *
     * @param string $name The parameter name.
     * @param string $value The parameter value.
     * @param string $id The parameter ID.
     */
    public function add_param($name, $value, $id = null) {
        if (!$id) {
            $id = $name;
        }
        $this->params[] = [
            'name' => $name,
            'value' => $value,
            'id' => $id
        ];
    }

    /**
     * Set the chooser instructions.
     *
     * @param lang_string $value The instructions.
     */
    public function set_instructions(lang_string $value) {
        $this->instructions = $value;
    }

    /**
     * Set the form method.
     *
     * @param string $value The method.
     */
    public function set_method($value) {
        $this->method = $value;
    }

    /**
     * Export for template.
     *
     * @param renderer_base The renderer.
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();

        $data->actionurl = $this->actionurl->out(false);
        $data->instructions = (string) $this->instructions;
        $data->method = $this->method;
        $data->paramname = $this->paramname;
        $data->params = $this->params;
        $data->sesskey = sesskey();
        $data->title = (string) $this->title;

        $data->sections = array_map(function($section) use ($output) {
            return $section->export_for_template($output);
        }, $this->sections);

        return $data;
    }

}
