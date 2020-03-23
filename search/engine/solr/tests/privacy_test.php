<?php
//

/**
 * Privacy provider tests.
 *
 * @package    search_solr
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy provider tests class.
 *
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search_solr_privacy_test extends \core_privacy\tests\provider_testcase {

    /**
     *  Verify that a collection of metadata is returned for this component and that it just links to an external location.
     */
    public function test_get_metadata() {
        $collection = new \core_privacy\local\metadata\collection('search_solr');
        $collection = \search_solr\privacy\provider::get_metadata($collection);
        $this->assertNotEmpty($collection);
        $items = $collection->get_collection();
        $this->assertEquals(1, count($items));
        $this->assertInstanceOf(\core_privacy\local\metadata\types\external_location::class, $items[0]);
    }
}
