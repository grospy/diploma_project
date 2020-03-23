<?php
//

/**
 * Provides the {@link filter_mathjaxloader_filter_testcase} class.
 *
 * @package     filter_mathjaxloader
 * @category    test
 * @copyright   2017 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot.'/filter/mathjaxloader/filter.php');

/**
 * Unit tests for the MathJax loader filter.
 *
 * @copyright 2017 David Mudrak <david@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_mathjaxloader_filter_testcase extends advanced_testcase {

    /**
     * Test the functionality of {@link filter_mathjaxloader::map_language_code()}.
     *
     * @param string $moodlelangcode the user's current language
     * @param string $mathjaxlangcode the mathjax language to be used for the moodle language
     *
     * @dataProvider test_map_language_code_expected_mappings
     */
    public function test_map_language_code($moodlelangcode, $mathjaxlangcode) {

        $filter = new filter_mathjaxloader(context_system::instance(), []);
        $this->assertEquals($mathjaxlangcode, $filter->map_language_code($moodlelangcode));
    }

    /**
     * Data provider for {@link self::test_map_language_code}
     *
     * @return array of [moodlelangcode, mathjaxcode] tuples
     */
    public function test_map_language_code_expected_mappings() {

        return [
            ['cz', 'cs'], // Explicit mapping.
            ['cs', 'cs'], // Implicit mapping (exact match).
            ['ca_valencia', 'ca'], // Implicit mapping of a Moodle language variant.
            ['pt_br', 'pt-br'], // Explicit mapping.
            ['en_kids', 'en'], // Implicit mapping of English variant.
            ['de_kids', 'de'], // Implicit mapping of non-English variant.
            ['es_mx_kids', 'es'], // More than one underscore in the name.
            ['zh_tw', 'zh-hant'], // Explicit mapping of the Taiwain Chinese in the traditional script.
            ['zh_cn', 'zh-hans'], // Explicit mapping of the Simplified Chinese script.
        ];
    }
}
