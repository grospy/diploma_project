<?php
//

/**
 * Document icon class.
 *
 * @package    core_search
 * @copyright  2018 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_search;

defined('MOODLE_INTERNAL') || die();

/**
 * Represents a document icon.
 *
 * @package    core_search
 * @copyright  2018 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class document_icon {
    /**
     * Icon file name.
     * @var string
     */
    protected $name;

    /** Icon file component.
     * @var string
     */
    protected $component;

    /**
     * Constructor.
     *
     * @param string $name Icon name.
     * @param string $component Icon component.
     */
    public function __construct($name, $component = 'moodle') {
        $this->name = $name;
        $this->component = $component;
    }

    /**
     * Returns name of the icon file.
     *
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Returns the component of the icon file.
     *
     * @return string
     */
    public function get_component() {
        return $this->component;
    }

}
