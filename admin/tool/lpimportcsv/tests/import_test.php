<?php
//
/**
 * External learning plans webservice API tests.
 *
 * @package tool_lpimportcsv
 * @copyright 2015 Damyon Wiese
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use tool_lpimportcsv\framework_importer;
use tool_lpimportcsv\framework_exporter;
use core_competency\api;

/**
 * External learning plans webservice API tests.
 *
 * @package tool_lpimportcsv
 * @copyright 2015 Damyon Wiese
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_lpimportcsv_import_testcase extends advanced_testcase {

    public function test_import_framework() {
        $this->resetAfterTest(true);
        $this->setAdminUser();

        $importer = new framework_importer(file_get_contents(__DIR__ . '/fixtures/example.csv'));

        $this->assertEquals('', $importer->get_error());

        $framework = $importer->import();
        $this->assertEmpty('', $importer->get_error());

        $this->assertGreaterThan(0, $framework->get('id'));

        $filters = [
            'competencyframeworkid' => $framework->get('id')
        ];
        $count = api::count_competencies($filters);
        $this->assertEquals(64, $count);

        // We can't test the exporter because it sends force-download headers.
    }


}
