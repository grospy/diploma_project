<?php
//

/**
 * GeoIP tests
 *
 * @package    core_iplookup
 * @category   phpunit
 * @copyright  2012 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * GeoIp data file parsing test.
 */
class core_iplookup_geoplugin_testcase extends advanced_testcase {

    public function setUp() {
        global $CFG;
        require_once("$CFG->libdir/filelib.php");
        require_once("$CFG->dirroot/iplookup/lib.php");

        if (!PHPUNIT_LONGTEST) {
            // we do not want to DDOS their server, right?
            $this->markTestSkipped('PHPUNIT_LONGTEST is not defined');
        }

        $this->resetAfterTest();

        $CFG->geoipfile = '';
    }

    public function test_ipv4() {
        $result = iplookup_find_location('50.0.184.0');

        $this->assertEquals('array', gettype($result));
        $this->assertEquals('San Francisco', $result['city']);
        $this->assertEquals(-122.3933, $result['longitude'], 'Coordinates are out of accepted tolerance', 0.01);
        $this->assertEquals(37.7697, $result['latitude'], 'Coordinates are out of accepted tolerance', 0.01);
        $this->assertNull($result['error']);
        $this->assertEquals('array', gettype($result['title']));
        $this->assertEquals('San Francisco', $result['title'][0]);
        $this->assertEquals('United States', $result['title'][1]);
    }

    public function test_geoip_ipv6() {
        $result = iplookup_find_location('2a01:8900:2:3:8c6c:c0db:3d33:9ce6');

        $this->assertNotNull($result['error']);
        $this->assertEquals($result['error'], get_string('invalidipformat', 'error'));
    }
}

