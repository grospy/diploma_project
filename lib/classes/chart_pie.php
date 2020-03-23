<?php
//

/**
 * Chart pie.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core;
defined('MOODLE_INTERNAL') || die();

/**
 * Chart pie class.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class chart_pie extends chart_base {

    /** @var bool $doughnut Whether the chart should be displayed as doughnut. */
    protected $doughnut = null;

    /**
     * Get parent JSON and add specific pie related attributes and values.
     *
     * @return array
     */
    public function jsonSerialize() { // @codingStandardsIgnoreLine (CONTRIB-6469).
        $data = parent::jsonSerialize();
        $data['doughnut'] = $this->get_doughnut();
        return $data;
    }

    /**
     * Get whether the chart should be displayed as doughnut.
     *
     * @return bool
     */
    public function get_doughnut() {
        return $this->doughnut;
    }

    /**
     * Set whether the chart should be displayed as doughnut.
     *
     * @param bool $doughnut True for doughnut type, false for pie.
     */
    public function set_doughnut($doughnut) {
        $this->doughnut = $doughnut;
    }
}
