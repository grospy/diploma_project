<?php
//

/**
 * Geopatterns for images.
 *
 * @package    core
 * @copyright  2018 Moodle
 * @author     Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class core_geopattern extends \RedeyeVentures\GeoPattern\GeoPattern {

    /**
     * Add variables.
     *
     * @param array $scss Associative array of variables and their values.
     * @return void
     */
    public function patternbyid($uniqueid) {
        $this->setString($uniqueid);
    }

    public function datauri() {
        return $this->toDataURI();
    }

}
