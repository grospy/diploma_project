<?php
//

/**
 * Class for normalising the date data.
 *
 * @package   core_calendar
 * @copyright 2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\external;

defined('MOODLE_INTERNAL') || die();

use core\external\exporter;
use renderer_base;
use moodle_url;

/**
 * Class for normalising the date data.
 *
 * @package   core_calendar
 * @copyright 2017 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class date_exporter extends exporter {

    /**
     * Constructor for date_exporter.
     *
     * @param array $data
     * @param array $related The related information
     */
    public function __construct($data, $related = []) {
        $data['timestamp'] = $data[0];
        unset($data[0]);

        parent::__construct($data, $related);
    }

    protected static function define_properties() {
        return [
            'seconds' => [
                'type' => PARAM_INT,
            ],
            'minutes' => [
                'type' => PARAM_INT,
            ],
            'hours' => [
                'type' => PARAM_INT,
            ],
            'mday' => [
                'type' => PARAM_INT,
            ],
            'wday' => [
                'type' => PARAM_INT,
            ],
            'mon' => [
                'type' => PARAM_INT,
            ],
            'year' => [
                'type' => PARAM_INT,
            ],
            'yday' => [
                'type' => PARAM_INT,
            ],
            'weekday' => [
                'type' => PARAM_RAW,
            ],
            'month' => [
                'type' => PARAM_RAW,
            ],
            'timestamp' => [
                'type' => PARAM_INT,
            ],
        ];
    }
}
