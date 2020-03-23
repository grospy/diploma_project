<?php
//

/**
 * Provides the {@link core_form\external_testcase} class.
 *
 * @package     core_form
 * @category    test
 * @copyright   2017 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_form;

use advanced_testcase;
use external_api;

defined('MOODLE_INTERNAL') || die();

global $CFG;

/**
 * Test cases for the {@link core_form\external} class.
 *
 * @copyright 2017 David Mudrak <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class external_testcase extends advanced_testcase {

    /**
     * Test the core_form_get_filetypes_browser_data external function
     */
    public function test_get_filetypes_browser_data() {

        $data = external::get_filetypes_browser_data('', true, '');
        $data = external_api::clean_returnvalue(external::get_filetypes_browser_data_returns(), $data);
        $data = json_decode(json_encode($data));

        // The actual data are tested in filetypes_util_test.php, here we just
        // make sure that the external function wrapper seems to work.
        $this->assertInternalType('object', $data);
        $this->assertInternalType('array', $data->groups);
    }
}
