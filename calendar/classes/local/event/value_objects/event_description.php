<?php
//

/**
 * Description value object.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\value_objects;

defined('MOODLE_INTERNAL') || die();

/**
 * Class representing a description value object.
 *
 * @copyright 2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class event_description implements description_interface {
    /**
     * @var string $value The description's text.
     */
    protected $value;

    /**
     * @var int $format The description's format.
     */
    protected $format;

    /**
     * Constructor.
     *
     * @param string $value  The description's value.
     * @param int    $format The description's format.
     */
    public function __construct($value, $format) {
        $this->value = $value;
        $this->format = $format;
    }

    public function get_value() {
        return $this->value;
    }

    public function get_format() {
        return $this->format;
    }
}
