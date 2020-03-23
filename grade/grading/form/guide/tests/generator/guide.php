<?php
//

/**
 * Generator for the gradingforum_guide plugin.
 *
 * @package    gradingform_guide
 * @category   test
 * @copyright  2018 Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tests\gradingform_guide\generator;

use gradingform_controller;
use stdClass;

/**
 * Test guide.
 *
 * @package    gradingform_guide
 * @category   test
 * @copyright  2018 Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class guide {

    /** @var array $criteria The criteria for this guide. */
    protected $criteria = [];

    /** @var string The name of this guide. */
    protected $name;

    /** @var string A description for this guide. */
    protected $description;

    /** @var array The guide options. */
    protected $options = [];

    /**
     * Create a new gradingform_guide_generator_criterion.
     *
     * @param string $name
     * @param string $description
     */
    public function __construct(string $name, string $description) {
        $this->name = $name;
        $this->description = $description;

        $this->set_option('alwaysshowdefinition', 1);
        $this->set_option('showmarkspercriterionstudents', 1);
    }

    /**
     * Creates the guide using the appropriate APIs.
     */
    public function get_definition(): stdClass {
        return (object) [
            'name' => $this->name,
            'description_editor' => [
                'text' => $this->description,
                'format' => FORMAT_HTML,
                'itemid' => 1
            ],
            'guide' => [
                'criteria' => $this->get_critiera_as_array(),
                'options' => $this->options,
                'comments' => [],
            ],
            'saveguide' => 'Continue',
            'status' => gradingform_controller::DEFINITION_STATUS_READY,
        ];
    }

    /**
     * Set an option for the rubric.
     *
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public function set_option(string $key, $value): self {
        $this->options[$key] = $value;
        return $this;
    }

    /**
     * Adds a criterion to the guide.
     *
     * @param criterion $criterion The criterion object (class below).
     * @return self
     */
    public function add_criteria(criterion $criterion): self {
        $this->criteria[] = $criterion;

        return $this;
    }

    /**
     * Get the criteria as an array for use in creation.
     *
     * @return array
     */
    protected function get_critiera_as_array(): array {
        $return = [];
        foreach ($this->criteria as $index => $criterion) {
            $return["NEWID{$index}"] = $criterion->get_all_values($index + 1);
        }

        return $return;
    }
}
