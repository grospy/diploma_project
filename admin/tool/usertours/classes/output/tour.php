<?php
//

/**
 * Tour renderable.
 *
 * @package    tool_usertours
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_usertours\output;

defined('MOODLE_INTERNAL') || die();

use tool_usertours\tour as toursource;

/**
 * Tour renderable.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tour implements \renderable {

    /**
     * @var The tour instance.
     */
    protected $tour;

    /**
     * The tour output.
     *
     * @param   toursource      $tour       The tour being output.
     */
    public function __construct (toursource $tour) {
        $this->tour = $tour;
    }

    /**
     * Prepare the data for export.
     *
     * @param   \renderer_base      $output     The output renderable.
     * @return  object
     */
    public function export_for_template(\renderer_base $output) {
        $result = (object) [
            'name'  => $this->tour->get_tour_key(),
            'steps' => [],
        ];

        foreach ($this->tour->get_steps() as $step) {
            $result->steps[] = (new step($step))->export_for_template($output);
        }

        return $result;
    }
}
