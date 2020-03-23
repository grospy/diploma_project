<?php
//

/**
 * Metadata registry tests.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
global $CFG;

/**
 * Metadata registry tests.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_dataprivacy_metadata_registry_testcase extends advanced_testcase {

    /**
     * Fetch the meta data and return it in a form that we can easily unit test.
     *
     * @return array the meta data.
     */
    protected function get_meta_data() {
        $metadataregistry = new \tool_dataprivacy\metadata_registry();
        $data = $metadataregistry->get_registry_metadata();
        $newdata = [];
        foreach ($data as $value) {
            $additional = [];
            foreach ($value['plugins'] as $moredata) {
                $additional[$moredata['raw_component']] = $moredata;
            }
            $newdata[$value['plugin_type_raw']] = $additional;
        }
        return $newdata;
    }

    /**
     * Test that we can fetch metadata about users for the whole system and that it matches the system count.
     */
    public function test_get_registry_metadata_count() {
        $data = $this->get_meta_data();

        $plugintypes = \core_component::get_plugin_types();

        // Check that we have the correct number of plugin types.
        $plugincount = count($plugintypes) + 1; // Plus one for core.
        $this->assertEquals($plugincount, count($data));

        // Check that each plugin count matches.
        foreach ($plugintypes as $plugintype => $notused) {
            $plugins = \core_component::get_plugin_list($plugintype);
            $this->assertEquals(count($plugins), count($data[$plugintype]));
        }

        // Let's check core subsystems.
        // The Privacy API adds an extra component in the form of 'core'.
        $coresubsystems = \core_component::get_core_subsystems();
        $this->assertEquals(count($coresubsystems) + 1, count($data['core']));
    }

    /**
     * Check that the expected null provider information is returned.
     */
    public function test_get_registry_metadata_null_provider_details() {
        $data = $this->get_meta_data();

        // Check details of core privacy (a null privder) are correct.
        $coreprivacy = $data['core']['core_privacy'];
        $this->assertEquals(1, $coreprivacy['compliant']);
        $this->assertNotEmpty($coreprivacy['nullprovider']);
    }

    /**
     * Check that the expected privacy provider information is returned.
     */
    public function test_get_registry_metadata_provider_details() {
        $data = $this->get_meta_data();

        // Check details of core rating (a normal provider) are correct.
        $corerating = $data['core']['core_rating'];
        $this->assertEquals(1, $corerating['compliant']);
        $this->assertNotEmpty($corerating['metadata']);
        $this->assertEquals('database_table', $corerating['metadata'][0]['type']);
        $this->assertNotEmpty($corerating['metadata'][0]['fields']);
    }
}
