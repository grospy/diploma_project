<?php
//

/**
 * Range processor splitting the course in parts and accumulating data from the start.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics\local\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * Range processor splitting the course in parts and accumulating data from the start.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class accumulative_parts extends base implements before_now {

    /**
     * The number of parts to split the analysable duration in.
     *
     * @return int
     */
    abstract protected function get_number_parts();

    /**
     * define_ranges
     *
     * @return array
     */
    protected function define_ranges() {

        $nparts = $this->get_number_parts();

        $rangeduration = ($this->analysable->get_end() - $this->analysable->get_start()) / $nparts;

        $ranges = array();
        for ($i = 0; $i < $nparts; $i++) {
            $end = $this->analysable->get_start() + intval($rangeduration * ($i + 1));
            if ($i === ($nparts - 1)) {
                // Better to use the end for the last one as we are using floor above.
                $end = $this->analysable->get_end();
            }
            $ranges[$i] = array(
                'start' => $this->analysable->get_start(),
                'end' => $end,
                'time' => $end
            );
        }

        return $ranges;
    }
}
