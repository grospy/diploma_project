<?php
//

/**
 * Contains event class for displaying the day name.
 *
 * @package   core_calendar
 * @copyright 2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;

/**
 * Class for displaying the day view.
 *
 * @package   core_calendar
 * @copyright 2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class day_name_exporter extends exporter {

    /**
     * @var int $dayno The day number.
     */
    protected $dayno;

    /**
     * @var string $shortname The formatted short name of the day.
     */
    protected $shortname;

    /**
     * @var string $fullname The formatted full name of the day.
     */
    protected $fullname;

    /**
     * Constructor.
     *
     * @param int $dayno The day number.
     * @param array $names The list of names.
     */
    public function __construct($dayno, $names) {
        $data = $names + ['dayno' => $dayno];

        parent::__construct($data, []);
    }

    /**
     * Return the list of properties.
     *
     * @return array
     */
    protected static function define_properties() {
        return [
            'dayno' => [
                'type' => PARAM_INT,
            ],
            'shortname' => [
                // Note: The calendar type class has already formatted the names.
                'type' => PARAM_RAW,
            ],
            'fullname' => [
                // Note: The calendar type class has already formatted the names.
                'type' => PARAM_RAW,
            ],
        ];
    }
}
